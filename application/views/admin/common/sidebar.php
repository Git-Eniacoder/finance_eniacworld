<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion border" id="sidenavAccordion">
                    <div class="sb-sidenav-menu bg-white py-2">
                        <div class="nav">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#project" aria-expanded="false" aria-controls="collapsePages"
                                >
                                Project Manage
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                            ></a>
                            <div class="collapse show" id="project" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link text-dark py-3 px-4" href="<?php echo base_url();?>admin/project_name"
                                ><div class="sb-nav-link-icon"><i class="fa mx-2 fa-link" aria-hidden="true"></i></div>
                                Create Project
                            </a>
                            <a class="nav-link text-dark py-3 px-4" href="<?php echo base_url();?>admin/project_show"
                                ><div class="sb-nav-link-icon"><i class="fa mx-2 fa-link" aria-hidden="true"></i></div>
                                All Project
                            </a>
                            <a class="nav-link text-dark py-3 px-4" href="<?php echo base_url();?>admin/project_invoice_view/fetch_invoice_all"
                                ><div class="sb-nav-link-icon"><i class="fa mx-2 fa-link" aria-hidden="true"></i></div>
                                View All Invoices
                            </a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#gst" aria-expanded="false" aria-controls="collapsePages"
                                >
                               GST (Goods & Service tax)
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                            ></a>
                            <div class="collapse" id="gst" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link text-dark py-3 px-4" href="<?php echo base_url();?>admin/project_name"
                                ><div class="sb-nav-link-icon"><i class="fa mx-2 fa-link" aria-hidden="true"></i></div>
                                Product Purchased
                            </a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#billing" aria-expanded="false" aria-controls="collapsePages"
                                >
                                Billings & Expenses 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                            ></a>
                            <div class="collapse" id="billing" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link text-dark py-3 px-4" href="<?php echo base_url();?>admin/project_name"
                                ><div class="sb-nav-link-icon"><i class="fa mx-2 fa-link" aria-hidden="true"></i></div>
                                Expenses Enter
                            </a>
                            <a class="nav-link text-dark py-3 px-4" href="<?php echo base_url();?>admin/project_show"
                                ><div class="sb-nav-link-icon"><i class="fa mx-2 fa-link" aria-hidden="true"></i></div>
                                See Reports
                            </a>
                            </nav>
                        </div>
                    </div>
                </nav>
            </div>