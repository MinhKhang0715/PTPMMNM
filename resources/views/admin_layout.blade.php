<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>

<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet" />
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css" />
    <link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/backend/css/jquery-ui.css')}}" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
    <script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
    <script src="{{asset('public/backend/js/morris.js')}}"></script>


</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="{{URL::to('/dashboard')}}" class="logo">
                    VISITORS
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->


            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{asset('public/backend/images/2.png')}}">
                            <!-- Xuất name trên mục icon admin -->
                            <span class="username">
                                <?php
                                $name = Auth::user();
                                if ($name) {
                                    echo $name;
                                }
                                ?>
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="{{URL::to('/logout-auth')}}"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href="{{URL::to('/dashboard')}}">
                                <i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        @hasrole(['stat'])
                        <li>
                            <a class="active" href="{{URL::to('/statistic')}}">
                                <i class="fa fa-book"></i>
                                <span>Thống Kê</span>
                            </a>
                        </li>
                        @endhasrole

                        @hasrole(['slider'])
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Slider</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-slider')}}">Thêm Slider</a></li>
                                <li><a href="{{URL::to('/manage-slider')}}">Quản Lý Slider</a></li>


                            </ul>
                        </li>
                        @endhasrole

                        @hasrole(['order'])
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Đơn Hàng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/manage-order')}}">Quản Lý đơn hàng</a></li>


                            </ul>
                        </li>
                        @endhasrole

                        @hasrole(['category'])
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh mục sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-category-product')}}">Thêm danh mục sản phẩm</a></li>
                                <li><a href="{{URL::to('/all-category-product')}}">Liệt kê danh sách sản phẩm</a></li>

                            </ul>
                        </li>
                        @endhasrole

                        @hasrole(['brand'])
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Thương hiệu sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-brand-product')}}">Thêm thương hiệu sản phẩm</a></li>
                                <li><a href="{{URL::to('/all-brand-product')}}">Liệt kê thương hiệu sản phẩm</a></li>

                            </ul>
                        </li>
                        @endhasrole

                        @hasrole(['product'])
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
                                <li><a href="{{URL::to('/all-product')}}">Liệt kê sản phẩm</a></li>

                            </ul>
                        </li>
                        @endhasrole

                        @hasrole(['admin'])
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Tài Khoản</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-user')}}">Thêm tài khoản</a></li>
                                <li><a href="{{URL::to('/all-user')}}">Phân quyền</a></li>

                            </ul>
                        </li>
                        @endhasrole
                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                @yield('admin_content')

            </section>
            <!-- footer -->
            <div class="footer">
                <div class="wthree-copyright">
                    <p>© 2077 Cycberpunk. All rights reserved | Design by <a href="http://w3layouts.com">Lac Khai Minh</a></p>
                </div>
            </div>
            <!-- / footer -->
        </section>
        <!--main content end-->
    </section>
    <script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('public/backend/js/scripts.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.form-validator.min.js')}}"></script>

    <script src="{{asset('public/backend/js/jquery-ui.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() { //hàm chạy trang thì load ajax
            load_gallery();

            function load_gallery() {
                var pro_id = $('.pro_id').val();
                var _token = $('input[name="_token"]').val();
                // alert(pro_id);
                $.ajax({
                    url: "{{URL('/select-gallery')}}",
                    method: "POST",
                    data: {
                        pro_id: pro_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#gallery_load').html(data);
                    }
                });
            }

            // hàm thay đổi thì sẽ chạy ajax
            $('#file').change(function() {
                var error = '';
                var files = $('#file')[0].files;

                if (files.length > 9) {
                    error += '<p>Bạn chọn tối đa 9 ảnh</p>';
                } else if (files.length == '') {
                    error += '<p>Bạn không được bỏ trống ảnh</p>';
                }

                if (error == '') {

                } else {
                    $('#file').val('');
                    $('#error_gallery').html('<span class="text-danger">' + error + '</span>');
                    return false;

                }


            });

            //hàm click khi click vào mục thì chạy ajax
            $(document).on('click', '.delete-gallery', function() {
                var gal_id = $(this).data('gal_id');
                var _token = $('input[name="_token"]').val();
                if (confirm('Bạn muốn xóa hình này không ?')) {
                    $.ajax({
                        url: "{{url('/delete-gallery')}}",
                        method: "POST",
                        data: {
                            gal_id: gal_id,
                            _token: _token
                        },
                        success: function(data) {
                            load_gallery();
                            $('error_gallery').html('<span class="text-danger">Xóa hình ảnh thành công</span>');
                        }

                    });
                }


            });

        });
    </script>

    <script type="text/javascript">
        $.validate({

        });
    </script>
    <script>
        CKEDITOR.replace('ckeditor');
        CKEDITOR.replace('ckeditor1');
    </script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
    <!-- morris JavaScript -->
    <script>
        $(document).ready(function() {
            //BOX BUTTON SHOW AND CLOSE
            jQuery('.small-graph-box').hover(function() {
                jQuery(this).find('.box-button').fadeIn('fast');
            }, function() {
                jQuery(this).find('.box-button').fadeOut('fast');
            });
            jQuery('.small-graph-box .box-close').click(function() {
                jQuery(this).closest('.small-graph-box').fadeOut(200);
                return false;
            });

            //CHARTS
            function gd(year, day, month) {
                return new Date(year, month - 1, day).getTime();
            }

            graphArea2 = Morris.Area({
                element: 'hero-area',
                padding: 10,
                behaveLikeLine: true,
                gridEnabled: false,
                gridLineColor: '#dddddd',
                axes: true,
                resize: true,
                smooth: true,
                pointSize: 0,
                lineWidth: 0,
                fillOpacity: 0.85,
                data: [{
                        period: '2015 Q1',
                        iphone: 2668,
                        ipad: null,
                        itouch: 2649
                    },
                    {
                        period: '2015 Q2',
                        iphone: 15780,
                        ipad: 13799,
                        itouch: 12051
                    },
                    {
                        period: '2015 Q3',
                        iphone: 12920,
                        ipad: 10975,
                        itouch: 9910
                    },
                    {
                        period: '2015 Q4',
                        iphone: 8770,
                        ipad: 6600,
                        itouch: 6695
                    },
                    {
                        period: '2016 Q1',
                        iphone: 10820,
                        ipad: 10924,
                        itouch: 12300
                    },
                    {
                        period: '2016 Q2',
                        iphone: 9680,
                        ipad: 9010,
                        itouch: 7891
                    },
                    {
                        period: '2016 Q3',
                        iphone: 4830,
                        ipad: 3805,
                        itouch: 1598
                    },
                    {
                        period: '2016 Q4',
                        iphone: 15083,
                        ipad: 8977,
                        itouch: 5185
                    },
                    {
                        period: '2017 Q1',
                        iphone: 10697,
                        ipad: 4470,
                        itouch: 2038
                    },

                ],
                lineColors: ['#eb6f6f', '#926383', '#eb6f6f'],
                xkey: 'period',
                redraw: true,
                ykeys: ['iphone', 'ipad', 'itouch'],
                labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });


        });
    </script>
    <!-- calendar -->
    <script type="text/javascript" src="{{asset('public/backend/js/monthly.js')}}"></script>
    <script type="text/javascript">
        $(window).load(function() {

            $('#mycalendar').monthly({
                mode: 'event',

            });

            $('#mycalendar2').monthly({
                mode: 'picker',
                target: '#mytarget',
                setWidth: '250px',
                startHidden: true,
                showTrigger: '#mytarget',
                stylePast: true,
                disablePast: true
            });

            switch (window.location.protocol) {
                case 'http:':
                case 'https:':
                    // running on a server, should be good.
                    break;
                case 'file:':
                    alert('Just a heads-up, events will not work when run locally.');
            }

        });
    </script>

    <script type="text/javascript">
        $(function() {
            $("#datepicker").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "yy-mm-dd",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
                duration: "slow"
            });
            $("#datepicker2").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "yy-mm-dd",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
                duration: "slow"
            });
        });
    </script>
    <!-- //calendar -->

</body>

</html>