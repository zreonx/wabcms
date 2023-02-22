                </div>
        </div>
</div>
        
        <script src="../js/main.js"></script>
        <script src="../js/sidenav.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js" type="text/javascript"></script>
        
        <script type="text/javascript">
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
                })
        </script>
        <script>
                $(document).ready(function() {
                        $('#swap1').on('click', function (e) {
                                $.cookie("lastactive", $(this).data("value"));
                        });   
                        $('#swap2').on('click', function (e) {      
                                $.cookie("lastactive", $(this).data("value"));    
                        }); 
                });

                $(function(){
                        $("#myTab #swap1").tab('show');  
                        if($.cookie("lastactive") != undefined && $.cookie("lastactive") == "2") {
                                 $("#myTab #swap2").tab('show');   
                        }
                }); 
                
        </script>
        
</body>
</html>