<?php 
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';
?>

<div class="panel p-3">
    <h1 class="panel-title">Desinations</h1>
    <div class="card min-vh-100 c-scroll">
        <div class="card-body d-flex flex-column">
            <div class="designee-list-grid">
                <div class="card card-designee">
                    <div class="card-body">
                        <div class="designation d-flex justify-content-center flex-column">
                            <div class="title">
                                <h3 class="fs-5 text-center">BSIS Program Head</h3>
                            </div>
                            <div class="designee-body mb-2 align-self-center">
                                <div class="btn btn-badge">
                                    Students <span class="badge badge-color">4</span>
                                </div>
                                <div class="btn btn-badge">  
                                    Cleared <span class="badge badge-color">100</span>
                                </div>
                            </div>
                            <div class="designee-footer align-self-center">
                                <a href="#" class="btn btn-primary">View Designation</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                
                
            </div>
        </div>
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>