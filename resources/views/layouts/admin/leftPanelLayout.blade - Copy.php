@php
$segment_1 = request()->segment(1);
$segment_2 = request()->segment(2);
$admin_type = Session::get('admin_type');
$merchant_type = Session::get('merchant_type');

$category_list=App\Common::listingData($where=['status'=>1],$table='category',$data=['*'],'id','ASC');

@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4"> <a href="index3.html" class="brand-link"> <img
            src="{{ asset('public/front/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8"> <span
            class="brand-text font-weight-light">Tour</span> </a>
  <div class="sidebar"> 
    <!--<div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image"> <img src="{{ asset('public/front/dist/img/user2-160x160.jpg') }} " class="img-circle elevation-2" alt="User Image"> </div>
      <div class="info"> <a href="#" class="d-block">Alexander Pierce</a> </div>
    </div>-->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item"> <a href="{{ url('administrator/dashboard') }}"
                        class="nav-link @if($active == 'dashboard') active @endif"> <i
                            class="nav-icon fas fa-tachometer-alt"></i>
          <p> Dashboard </p>
          </a> </li>
        <li class="nav-item"> <a href="{{ url('administrator/upi') }}"
                        class="nav-link @if ($active == 'upi') active @endif"> <i
                            class="nav-icon fa fa-credit-card"></i>
          <p> Manage UPI </p>
          </a> </li>
        <li
                    class="nav-item @if($active == 'category') menu-open @endif @if($active == 'news') menu-open @endif @if($active == 'slider') menu-open @endif @if($active == 'slot') menu-open @endif @if($active == 'cp_slot') menu-open @endif @if($active == 'winningPrice') menu-open @endif"> <a href="#"
                        class="nav-link @if($active == 'category') active @endif @if($active == 'news') active @endif @if($active == 'slider') active @endif @if($active == 'slot') active @endif @if($active == 'cp_slot') active @endif @if($active == 'winningPrice') active @endif"> <i class="nav-icon fas fa-folder"></i>
          <p> Master <i class="fas fa-angle-left right"></i> </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"> <a href="{{ url('administrator/news') }}"
                                class="nav-link @if($active == 'news') active @endif"> <i
                                    class="far fa-circle nav-icon"></i>
              <p>News</p>
              </a> </li>
            <li class="nav-item"> <a href="{{ url('administrator/category') }}"
                                class="nav-link @if($active == 'category') active @endif"> <i
                                    class="far fa-circle nav-icon"></i>
              <p>Game Name</p>
              </a> </li>
            <li class="nav-item"> <a href="{{ url('administrator/slider') }}"
                                class="nav-link @if($active == 'slider') active @endif"> <i
                                    class="far fa-circle nav-icon"></i>
              <p>Slider</p>
              </a> </li>
            <li class="nav-item"> <a href="{{ url('administrator/slot') }}"
                                class="nav-link @if($active == 'slot') active @endif"> <i
                                    class="far fa-circle nav-icon"></i>
              <p>Slot</p>
              </a> </li>
            <li class="nav-item"> <a href="{{ url('administrator/cp_slot') }}"
                                class="nav-link @if($active == 'cp_slot') active @endif"> <i
                                    class="far fa-circle nav-icon"></i>
              <p>CP Digits</p>
              </a> </li>
            <li class="nav-item"> <a href="{{ url('administrator/winning-price') }}"
                                class="nav-link @if($active == 'winningPrice') active @endif"> <i
                                    class="far fa-circle nav-icon"></i>
              <p>Winning Price</p>
              </a> </li>
          </ul>
        </li>
        <li
                    class="nav-item @if($active == 'addition') menu-open @endif @if($active == 'deduction') menu-open @endif"> <a href="#"
                        class="nav-link @if($active == 'addition') active @endif @if($active == 'deduction') active @endif"> <i class="nav-icon fas fa-check-circle"></i>
          <p> Money <i class="fas fa-angle-left right"></i> </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"> <a href="{{ url('administrator/money/addition') }}"
                                class="nav-link @if($active == 'addition') active @endif"> <i
                                    class="far fa-circle nav-icon"></i>
              <p>Addition</p>
              </a> </li>
            <li class="nav-item"> <a href="{{ url('administrator/money/deduction') }}"
                                class="nav-link @if($active == 'deduction') active @endif"> <i
                                    class="far fa-circle nav-icon"></i>
              <p>Deduction</p>
              </a> </li>
          </ul>
        </li>
        <li
                    class="nav-item @if($active == 'withdraw_request') menu-open @endif @if($active == 'balance_request') menu-open @endif @if($active == 'balance_request_report') menu-open @endif @if($active == 'withdraw_request_report') menu-open @endif @if($active == 'transactions_history_report') menu-open @endif @if($active == 'upi_request_report') menu-open @endif @if($active == 'upi_request_details_report') menu-open @endif"> <a href="#"
                        class="nav-link @if($active == 'withdraw_request') active @endif @if($active == 'upi_balance_request') active @endif @if($active == 'balance_request') active @endif @if($active == 'upi_request_report') active @endif @if($active == 'upi_request_details_report') active @endif"> <i class="nav-icon fas fa-check-circle"></i>
          <p> Approve <i class="fas fa-angle-left right"></i> </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"> <a href="{{ url('administrator/upi_balance_request') }}"
                                class="nav-link @if($active == 'upi_balance_request') active @endif"> <i
                                    class="far fa-circle nav-icon"></i>
              <p>UPI Transfer Money</p>
              </a> </li>
            <li class="nav-item"> <a href="{{ url('administrator/balance_request') }}"
                                class="nav-link @if($active == 'balance_request') active @endif"> <i
                                    class="far fa-circle nav-icon"></i>
              <p>Transfer Money</p>
              </a> </li>
            <li class="nav-item"> <a href="{{ url('administrator/withdraw_request') }}"
                                class="nav-link @if($active == 'withdraw_request') active @endif"> <i
                                    class="far fa-circle nav-icon"></i>
              <p>Withdraw Money</p>
              </a> </li>
            <li class="nav-item"> <a href="{{ url('administrator/balance_request_report') }}"
                                class="nav-link @if($active == 'balance_request_report') active @endif"> <i
                                    class="far fa-circle nav-icon"></i>
              <p>Transfer Details</p>
              </a> </li>
            <li class="nav-item"> <a href="{{ url('administrator/withdraw_request_report') }}"
                                class="nav-link @if($active == 'withdraw_request_report') active @endif"> <i
                                    class="far fa-circle nav-icon"></i>
              <p>Withdraw Details</p>
              </a> </li>
            <li class="nav-item"> <a href="{{ url('administrator/transactions_history') }}"
                                class="nav-link @if($active == 'transactions_history_report') active @endif"> <i
                                    class="far fa-circle nav-icon"></i>
              <p>Transactions history</p>
              </a> </li>
            <li class="nav-item"> <a href="{{ url('administrator/upi_request_report') }}"
                                class="nav-link @if($active == 'upi_request_report') active @endif"> <i
                                    class="far fa-circle nav-icon"></i>
              <p>UPI Details</p>
              </a> </li>
            <li class="nav-item"> <a href="{{ url('administrator/upi_request_details_report') }}"
                                class="nav-link @if($active == 'upi_request_details_report') active @endif"> <i
                                    class="far fa-circle nav-icon"></i>
              <p>UPI More Details</p>
              </a> </li>
          </ul>
        </li>
        <li class="nav-item @if($active == 'transfer_report') menu-open @endif @if($active == 'withdraw_report') menu-open @endif"> <a href="#" class="nav-link @if($active == 'transfer_report') active @endif @if($active == 'withdraw_report') active @endif"> <i class="nav-icon fas fa-check-circle"></i>
          <p> Report <i class="fas fa-angle-left right"></i> </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"> <a href="{{ url('administrator/transfer_report') }}" class="nav-link @if($active == 'transfer_report') active @endif"> <i class="far fa-circle nav-icon"></i>
              <p>Transfer Report</p>
              </a> </li>
            <li class="nav-item"> <a href="{{ url('administrator/withdraw_report') }}" class="nav-link @if($active == 'withdraw_report') active @endif"> <i class="far fa-circle nav-icon"></i>
              <p>Withdraw Report</p>
              </a> </li>
          </ul>
        </li>
        <li class="nav-item"> <a href="{{ url('administrator/game') }}"
                        class="nav-link @if($active == 'game') active @endif"> <i class="nav-icon fas fa-dice"></i>
          <p> Manage Game </p>
          </a> </li>
        <li
                    class="nav-item @if($active == 'showbid') menu-open @endif @if($active == 'history') menu-open @endif @if($active == 'indivisual') menu-open @endif @if($active == 'user_bet_history') menu-open @endif"> <a href="#"
                        class="nav-link @if($active == 'showbid') active @endif @if($active == 'history') active @endif @if($active == 'indivisual') active @endif @if($active == 'user_bet_history') active @endif"> <i class="nav-icon fas fa-history"></i>
          <p> Play History <i class="fas fa-angle-left right"></i> </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"> <a href="{{ url('administrator/playhistory/showbid') }}"
                                class="nav-link @if($active == 'showbid') active @endif"> <i
                                    class="far fa-circle nav-icon"></i>
              <p>Total Bet</p>
              </a> </li>
            <li class="nav-item"> <a href="{{ url('administrator/playhistory/history') }}"
                                class="nav-link @if($active == 'history') active @endif"> <i
                                    class="far fa-circle nav-icon"></i>
              <p>Bet History</p>
              </a> </li>
            <li class="nav-item"> <a href="{{ url('administrator/playhistory/user_bet_history') }}"
                                class="nav-link @if($active == 'user_bet_history') active @endif"> <i
                                    class="far fa-circle nav-icon"></i>
              <p>User Bet History</p>
              </a> </li>
            <li class="nav-item"> <a href="{{ url('administrator/playhistory/indivisual') }}"
                                class="nav-link @if($active == 'indivisual') active @endif"> <i
                                    class="far fa-circle nav-icon"></i>
              <p>Indivisual History</p>
              </a> </li>
          </ul>
        </li>
        <li
                    class="nav-item @if($active == 'daily') menu-open @endif @if($active == 'monthly') menu-open @endif"> <a href="#"
                        class="nav-link @if($active == 'daily') active @endif @if($active == 'monthly') active @endif"> <i class="nav-icon fas fa-history"></i>
          <p> Game Status <i class="fas fa-angle-left right"></i> </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"> <a href="{{ url('administrator/game_status/daily') }}"
                                class="nav-link @if($active == 'daily') active @endif"> <i
                                    class="far fa-circle nav-icon"></i>
              <p>Daily Report</p>
              </a> </li>
            <li class="nav-item"> <a href="{{ url('administrator/game_status/monthly') }}"
                                class="nav-link @if($active == 'monthly') active @endif"> <i
                                    class="far fa-circle nav-icon"></i>
              <p>Monthly History</p>
              </a> </li>
          </ul>
        </li>
        <li class="nav-item @if($segment_2 == 'result') menu-open @endif "> <a href="#"
                        class="nav-link @if($segment_2 == 'set_result') active @endif"> <i
                            class="nav-icon fas fa-copy"></i>
          <p> Set Result <i class="fas fa-angle-left right"></i> <span class="badge badge-info right">
            <?=count($category_list);?>
            </span> </p>
          </a> @if(!empty($category_list))
          <ul class="nav nav-treeview">
            @foreach($category_list as $row)
            <li class="nav-item"> <a href="{{ url('administrator/result/') }}/{{$row->id}}"
                                class="nav-link @if($active == $row->slug) active @endif"> <i
                                    class="far fa-circle nav-icon"></i>
              <p>{{$row->name}}</p>
              </a> </li>
            @endforeach
          </ul>
          @endif </li>
        <li class="nav-item"> <a href="{{ url('administrator/news_board') }}"
                        class="nav-link @if($active == 'news_board') active @endif"> <i
                            class="nav-icon fas fa fa-list"></i>
          <p> Manage News Board</p>
          </a> </li>
        <li class="nav-item"> <a href="{{ url('administrator/user') }}"
                        class="nav-link @if($active == 'user') active @endif"> <i class="nav-icon fas fa fa-user"></i>
          <p> Account List </p>
          </a> </li>
        <li class="nav-item"> <a href="{{ url('administrator/settings') }}"
                        class="nav-link @if($active == 'settings') active @endif"> <i
                            class="nav-icon fas fa fa-cog"></i>
          <p> Settings</p>
          </a> </li>
      </ul>
    </nav>
  </div>
</aside>
