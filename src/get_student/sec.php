<?php
include('../dbcon.php');
?>

<table id = "sec" class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Rank.
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Votes
                          </th>
                          
                        </tr>
                      </thead>
                      <tbody>
                      <?php
    $sql = "SELECT * FROM vote_counting WHERE position = 'Secretary' ORDER BY count DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $counter = 0; // Counter to track the row
        while ($row = $result->fetch_assoc()) {
            $counter++;
            ?>
                        <tr>
                          <td class="py-1">
                          <?php
                            
                            $imageSource = '';
                            switch ($counter) {
                                case 1:
                                    $imageSource = '../assets/icons/first.png';
                                    break;
                                case 2:
                                    $imageSource = '../assets/icons/second.png';
                                    break;
                                case 3:
                                    $imageSource = '../assets/icons/third.png';
                                    break;
                                default:
                                    $imageSource = '../assets/icons/ssglogo.jpg';
                                    break;
                            }
                            ?>
                            <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
                          </td>
                          <td>
                          <?php echo $row['name']; ?>
                          </td>
                          
                          <td>
                          <?php echo $row['count']; ?>
                          </td>
                         
                        </tr>
                        <?php
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                        
                      </tbody>
                    </table>