<!DOCTYPE html>
<html>
<head>
    <title>Load Page</title>
    <?php include 'link.php'; ?>
</head>
<body>
<?php include 'nav_bar.php'; ?>
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-4">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="student id">Student Id</label>
                    <input type="text" class="form-control" id="student id" name="student_id">
                </div>
                <div class="form-group">
                    <label for="Page Amount">Page Amount</label>
                    <input type="text" class="form-control" id="Page Amount" name="page_amount">
                </div>
                <div class="mt-md-auto">
                    <button type="submit" class="btn btn-primary">Load Page</button>
                </div>

            </form>
        </div>
    </div>

</body>
</html>
