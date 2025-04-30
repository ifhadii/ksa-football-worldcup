<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<div class="main-content">
 <div class="page-content">
       <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Update Footer</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Footer </a></li>
                                        <li class="breadcrumb-item active">Update</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-xxl-9">
                            <div class="card mt-xxl-n5">
                                <div class="card-header">
                                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab" aria-selected="false">
                                                <i class="fas fa-home"></i> Update Footer
                                            </a>
                                        </li>


                                    </ul>
                                </div>
                                <div class="card-body p-4">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                            <form action="javascript:void(0);">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Header</label>
                                                            <input type="text" class="form-control" id="firstnameInput" placeholder="Enter your firstname" value="Dave">
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-12">
                                                    <div class="mb-3 pb-2">
                                                            <label for="exampleFormControlTextarea" class="form-label">Footer Content</label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea" placeholder="Enter Page Content" rows="3"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="submit" class="btn btn-primary">Update Footer</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <?php include "footer.php"; ?>
