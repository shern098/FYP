                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <div class="clock  mb-0 text-gray-800"> </div>
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                    </ul>
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->

                        <a class="mr-2 d-none d-lg-inline text-gray-600 small" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>

                </nav>

                <script>
                    $(document).ready(function() {
                        function showUnreadNotifications(option = "") {
                            $.ajax({
                                url: "FetchNoti.php",
                                method: "POST",
                                data: {
                                    option: option,
                                },
                                dataType: "json",
                                success: function(data) {
                                    $("#noti-item ").html(data.notification);
                                    if (data.unreadNotications > 0 && data.unreadNotications <= 4) {
                                        $(".badge-counter").html(data.unreadNotications);
                                    }else if (data.unreadNotications >= 4){
                                        $(".badge-counter").html("4+");
                                    }
                                    else if (data.unreadNotications == 0 ){
                                        $(".badge-counter").html("");

                                    }
                                },
                            });
                        }
                        setInterval(function(){
                            showUnreadNotifications();
                        },5000)
                    

                       
                
                    });
       
                    </script>
                <!-- End of Topbar -->