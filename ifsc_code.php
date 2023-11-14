<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ifsc";
$db = new mysqli($servername, $username, $password, $database);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$searchResults = array();
$bank_ifsc = "";
$bank_micr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bankName = $_POST["bank_name"];
    $bankDistrict = $_POST["bank_district"];
    $bankCity = $_POST["bank_city"];
    $bankBranch = $_POST["bank_branch"];

    $query = "SELECT * FROM bank_details WHERE 
              bank_name LIKE '%$bankName%' AND
              bank_district LIKE '%$bankDistrict%' AND
              bank_city LIKE '%$bankCity%' AND
              bank_branch LIKE '%$bankBranch'";

    $result = $db->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $searchResults[] = $row;
        }
    }
    if (!empty($searchResults)) {
        $bank_ifsc = isset($searchResults[0]['bank_ifsc']) ? $searchResults[0]['bank_ifsc'] : '';
        $bank_micr = isset($searchResults[0]['bank_micr']) ? $searchResults[0]['bank_micr'] : '';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>IFSC Code</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f2f2f2;
            height: 100px;
        }

        .move-box {
            width: 600px;
            height: 500px;
            background-color: white;
            position: relative;
            top: 55%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .form-control {
            height: 70px;
            border: 2px solid skyblue;
        }

        .input-group-prepend {
            border: 2px solid skyblue;
            box-shadow: -10px 10px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="move-box">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-11">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <div class="form-group position-relative">
                                        <label for="bank_name">Select a Bank</label>
                                        <div class="input-group">
                                            <select class="form-control" id="bank_name" name="bank_name">
                                                <option value="">Select a Bank</option>
                                                <?php
                                                // Fetch bank names from the database
                                                $query = "SELECT DISTINCT bank_name FROM bank_details";
                                                $result = $db->query($query);

                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<option value="' . $row['bank_name'] . '">' . $row['bank_name'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="input-group">
    <select class="form-control" id="bank_district" name="bank_district">
        <option value="">Select a District</option>
        <?php
        if (!empty($bankName)) {
            // Fetch district names for the selected bank from the database
            $query = "SELECT DISTINCT bank_district FROM bank_details WHERE bank_name = '$bankName'";
            $result = $db->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['bank_district'] . '">' . $row['bank_district'] . '</option>';
                }
            }
        }
        ?>
    </select>
</div>

                                        <br>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="bank_city" name="bank_city" placeholder="Select City">
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="bank_branch" name="bank_branch" placeholder="Select Branch">
                                        </div>
                                        <br>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="quantity" placeholder="Search by IFSC/MICR Code..."
                                                    value="<?php echo (isset($searchResults[0]['bank_ifsc']) ? $searchResults[0]['bank_ifsc'] : '') . ' / ' . (isset($searchResults[0]['bank_micr']) ? $searchResults[0]['bank_micr'] : ''); ?>">
                                                <div class="custom-image" id="search-icon">
                                                    <button type="submit" class="btn btn-primary" style="background-color: skyblue; padding: 10px;">
                                                        <img src="https://static-00.iconduck.com/assets.00/search-icon-2044x2048-psdrpqwp.png" alt="Search Icon"
                                                            style="width: 40px; height: 48px;">
                                                    </button>
                                                </div>
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

    <!-- Include Bootstrap JS (optional, if needed) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

    <script>
$(document).ready(function() {
    $("#bank_name").on("change", function() {
        var selectedBank = $(this).val();
        
        if (selectedBank) {
            $.ajax({
                type: "POST",
                url: "get_districts.php",
                data: { bank_name: selectedBank },
                success: function(response) {
                    $("#bank_district").html(response);
                }
            });
        } else {
            $("#bank_district").html('<option value="">Select a District</option>');
        }
    });
});
</script>


</body>

</html>
