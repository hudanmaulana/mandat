<!-- Page -->
<div class="page" id="mainContent">
    <div class="page-header">
        <h1 class="page-title">{page_heading}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a class="ajax" href="{url}">{page_heading}</a></li>
        </ol>

        <div class="page-header-actions">
            <a class="btn btn-sm btn-primary btn-round ajax" href="{action}">
                <i class="icon md-plus" aria-hidden="true"></i>
                <span class="hidden-sm-down">ADD</span>
            </a>
        </div>
    </div>

    <div class="page-content">
        <!-- Panel Basic -->
        <div class="panel">
            <header class="panel-heading">
                <div class="panel-actions"></div>
                <h3 class="panel-title">Basic</h3>
            </header>
            <div class="panel-body">
                <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                    <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th><i class="icon md-view-headline" aria-hidden="true"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Damon</td>
                        <td>5516 Adolfo Green</td>
                        <td>Littelhaven</td>
                        <td>85</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-default dropdown-toggle" id="exampleColorDropdown1"
                                        data-toggle="dropdown" aria-expanded="false">
                                    Default
                                </button>
                                <div class="dropdown-menu" aria-labelledby="exampleColorDropdown1" role="menu">
                                    <a class="dropdown-item" href="javascript:void(0)" role="menuitem">Action</a>
                                    <a class="dropdown-item" href="javascript:void(0)" role="menuitem">Another action</a>
                                    <a class="active dropdown-item" href="javascript:void(0)" role="menuitem">Something else here</a>
                                    <a class="dropdown-item" href="javascript:void(0)" role="menuitem">Separated link</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Torrey</td>
                        <td>1995 Richie Neck</td>
                        <td>West Sedrickstad</td>
                        <td>77</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-default dropdown-toggle" id="exampleColorDropdown1"
                                        data-toggle="dropdown" aria-expanded="false">
                                    Default
                                </button>
                                <div class="dropdown-menu" aria-labelledby="exampleColorDropdown1" role="menu">
                                    <a class="dropdown-item" href="javascript:void(0)" role="menuitem">Edit</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- End Panel Basic -->
    </div>
</div>
<!-- End Page -->