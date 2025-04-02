<?php
include('../dbcon.php');

$sql = "SELECT * FROM vote_counting WHERE position = 'Grade 11 Representative' ORDER BY count DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $counter = 0; // Counter to track the row
    while ($row = $result->fetch_assoc()) {
        $counter++;
        ?>
        <tr>
            <td class="w-30">
                <div class="d-flex px-2 py-1 align-items-center">
                    <div>
                        <?php
                        $imageSource = '';
                        switch ($counter) {
                            case 1:
                                $imageSource = 'img/first.png';
                                break;
                            case 2:
                                $imageSource = 'img/second.png';
                                break;
                            case 3:
                                $imageSource = 'img/third.png';
                                break;
                            default:
                                $imageSource = 'img/ssglogo.png';
                                break;
                        }
                        ?>
                        <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
                    </div>
                    <div class="ms-4">
                        <p class="text-xs font-weight-bold mb-0">Name:</p>
                        <h6 class="text-sm mb-0"><?php echo $row['name']; ?></h6>
                    </div>
                </div>
            </td>

            <td>
                <div class="text-center">
                    <p class="text-xs font-weight-bold mb-0">Current Votes:</p>
                    <h6 class="text-sm mb-0"><?php echo $row['count']; ?></h6>
                </div>
            </td>
        </tr>
    <?php
    }
} else {
    echo "0 results";
}
?>

