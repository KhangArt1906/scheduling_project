<link rel="stylesheet" href="./assets/css/pagination.css">
<div class="content-wrapper">
    <div class="container">
        <section class="content">

            <div class="col-md-12">
                <div class="box box-warning">

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-14">
                                <h2>System Requirements</h2>
                                <div class="pagination-header">
                                    <div class="dropdown-container">
                                        <select name="" id="table-size">
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="30">30</option>
                                            <option value="50">50</option>
                                        </select>
                                    </div>
                                    <span>
                                        Seach Software
                                        <input class="software_form" id="myInput" type="text"
                                            placeholder="Example: Power Designer">
                                    </span>
                                </div>

                                <table id="software_hardware" class="table table-bordered table-striped"
                                    style="margin-right:-10px">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">STT</th>
                                            <th style="text-align: center;">Software Application</th>
                                            <th style="text-align: center;">Configuration</th>
                                        </tr>
                                    </thead>

                                    <tbody id="myTable">
                                        <!-- Power Designer -->


                                    </tbody>


                                </table>

                                <div class="pagination-footer">
                                    <span class="pagination-details"></span>
                                    <div class="pagination-buttons">


                                    </div>
                                </div>

                            </div>
                            <!--col end -->
                            <div class="col-md-6">


                            </div>
                            <!--col end-->
                        </div>
                        <!--row end-->


                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col (right) -->







        </section><!-- /.content -->

    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
$(document).ready(function() {
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>

<script src="../admin/assets/js/pagination.js"></script>