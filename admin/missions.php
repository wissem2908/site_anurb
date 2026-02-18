<?php include "includes/header.php"; ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Missions</h1>
   <div class="card shadow mb-4" id="news_list_card">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des missions</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="missions_table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Titre</th>
                    
                           <th>Description</th>
                            <th>Status</th>
                            <th>Date de creation</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Image</th>
                            <th>Titre</th>
                           <th>Description</th>
                            <th>Status</th>
                            <th>Date de creation</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody id="missions_tbody">


                    </tbody>
                </table>
            </div>
        </div>
    </div>
                </div>
                <!-- /.container-fluid -->

    <?php include "includes/footer.php"; ?>        


    <script>


        function get_missions(){
            $.ajax({
                url:'assets/php/missions/get_missions.php',
                method:'POST',
                success:function(response){
                    console.log(response)
                    var data = JSON.parse(response)

                    var missions = "";
                    for(var i=0; i <data.length; i++){
                        missions+=`<tr><td> </td><td>${data[i].titre}</td><td>${data[i].description}</td><td>${data[i].status}</td><td>${data[i].created_at}</td><td></td></tr>`
                    }
                    $('#missions_tbody').append(missions)
                }
            })
        }
         get_missions()
    </script>