<div class="page" id="mainContent">
    <div class="page-header">
        <h1 class="page-title">{page_heading}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a class="ajax" href="{url}">{page_heading}</a></li>
        </ol>
    </div>

    <div class="page-content">
        <div class="panel">
            <div class="panel-body container-fluid">
                <div class="row row-lg">
                    <div class="col-md-12">
                        <!-- Example Basic Form (Form grid) -->
                        <div class="example-wrap">
<!--                            <h4 class="example-title">Basic Form (Form grid)</h4>-->
                            <div class="example" id="mainform">
                                <form id="formsubmit" action="{action}" method="POST" onsubmit="submitForm('{url}')" autocomplete="off">
                                    <div class="row">
                                        <div class="form-group form-material col-md-6">
                                            <label class="form-control-label" for="inputBasicFirstName">First Name</label>
                                            <input type="text" class="form-control" id="inputBasicFirstName" name="first_name" placeholder="First Name" autocomplete="off" value="{first_name}">
                                        </div>
                                        <div class="form-group form-material col-md-6">
                                            <label class="form-control-label" for="inputBasicLastName">Last Name</label>
                                            <input type="text" class="form-control" id="inputBasicLastName" name="last_name" placeholder="Last Name" autocomplete="off" value="{last_name}">
                                        </div>
                                    </div>
                                    <div class="form-group form-material">
                                        <label class="form-control-label">Gender</label>
                                        <div>
                                            <div class="radio-custom radio-default radio-inline">
                                                <input type="radio" id="inputBasicMale" name="gender" value="male">
                                                <label for="inputBasicMale">Male</label>
                                            </div>
                                            <div class="radio-custom radio-default radio-inline">
                                                <input type="radio" id="inputBasicFemale" name="gender" value="female">
                                                <label for="inputBasicFemale">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicEmail">Email Address</label>
                                        <input type="email" class="form-control" id="inputBasicEmail" name="email" placeholder="Email Address" autocomplete="off" value="{email}">
                                    </div>
                                    <div class="form-group form-material" data-plugin="formMaterial">
                                        <label class="form-control-label" for="textarea">Description</label>
                                        <textarea class="form-control" id="textarea" name="description" rows="3">{description}</textarea>
                                    </div>
                                    <div class="form-group form-material">
                                        <button type="submit" class="btn btn-primary waves-effect waves-classic"><i class="icon md-floppy" aria-hidden="true"></i> Simpan</button>
                                        <a href="{url}" class="btn btn-danger waves-effect waves-classic ajax"><i class="icon md-arrow-left" aria-hidden="true"></i> Batal</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- End Example Basic Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>