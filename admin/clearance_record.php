<?php include_once '../includes/main.header.php' ?>

<div class="panel p-3">
    <h1 class="panel-title">Clearance</h1>
    <div class="card c-scroll">
        <div class="card-body">
            <table class="clearance-table table c-scroll">
                <tr>
                    <td>#</td>
                    <td>Type</td>
                    <td>Semester</td>
                    <td>Academic Year</td>
                    <td>Beneficiaries</td>
                    <td>date_issued</td>
                    <td>date_end</td>
                    <td>Status</td>
                    <td>Action</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Finals Clearance</td>
                    <td>2nd</td>
                    <td>2022-2023</td>
                    <td>Students</td>
                    <td>2022-12-25</td>
                    <td>2022-12-30</td>
                    <td>Active</td>
                    <td>
                        <button class="btn btn-success" type="submit">Activate</button>
                        <button class="btn btn-danger" type="submit">Deactivate</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>