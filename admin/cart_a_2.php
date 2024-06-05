<?php
error_reporting(error_reporting() & ~E_NOTICE);
session_start();

$p_id = mysqli_real_escape_string($condb, $_GET['p_id']);
$actdd = mysqli_real_escape_string($condb, 'add');
$act = mysqli_real_escape_string($condb, $_GET['act']);

if ($actdd == 'add' && !empty($p_id)) //เช็คว่า $act=='add' และ p_id ไม่ใช่ค้าว่างให้ทำเงื่อนไข
{
  if (isset($_SESSION['cart'][$p_id])) //ถ้าเจอ p_id ในตระกร้า
  {
    $_SESSION['cart'][$p_id]++; //ให้เพิ่มทีละ 1
  } else //ถ้าไม่เจอให้สินค้าที่ส่งมานั้น
  {
    $_SESSION['cart'][$p_id] = 1; //ให้สินค้านั้นเท่ากับๅ
  }
}

// session_destroy();
// header("location: cart.php");

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
// exit();

if ($act == 'remove' && !empty($p_id))  // ยกเลิกการสั่งซื้อ
{
  unset($_SESSION['cart'][$p_id]);
}

if ($act == 'update') {
  $amount_array = $_POST['amount'];
  foreach ($amount_array as $p_id => $amount) {
    $_SESSION['cart'][$p_id] = $amount;
  }
}
?>

<form id="frmcart" name="frmcart" method="post" action="?t_id=<?php echo $t_id; ?>&b_id=<?php echo $b_id; ?>=1&act=update">
  <h4>รายการสั่งซื้อ</h4>
  <br>
  <table border="0" align="center" class="table table-hover table-bordered table-striped">

    <tr>
      <td width="1%">#</td>
      <td width="5%">สินค้า</td>
      <td width="4%">ราคา</td>
      <td width="15%">จำนวน</td>
      <td width="4%">รวม(บาท)</td>
      <td width="3%">ลบ</td>
    </tr>
    <?php
    $total = 0;

    if (!empty($_SESSION['cart'])) {
      $ii = 0;
      foreach ($_SESSION['cart'] as $p_id => $qty) {
        $sql = "SELECT * FROM tbl_product WHERE p_id = $p_id";
        $query = mysqli_query($condb, $sql);
        $row = mysqli_fetch_array($query);

        $sum = $row['p_price'] * $qty; // Calculate total price for this product
        $total += $sum; // Add to total cart price
        $pqty = $row['p_qty']; // Get stock quantity
        $ii++;
    ?>
        <tr>
          <td><?= $ii ?></td>
          <td>
            <?= $row["p_name"] ?><br>
            สต๊อก <?= $row['p_qty'] ?> รายการ
          </td>
          <td align='right'><?= number_format($row["p_price"], 2) ?></td>
          <td align='right'>
            <input type='number' name='amount[<?= $p_id ?>]' value='<?= $qty ?>' size='2' class='form-control' min='0' max='<?= $pqty ?>' />
          </td>
          <td align='right'><?= number_format($sum, 2) ?></td>
          <td align='center'>
            <a href='list_l.php?p_id=<?= $p_id ?>&act=remove' class='btn btn-danger btn-xs'>ลบ</a>
          </td>
        </tr>
      <?php
      }
      ?>
      <tr>
        <td colspan='3'></td>
        <td bgcolor='#CEE7FF' align='center'><b>ราคารวม</b></td>
        <td align='right' bgcolor='#CEE7FF'><b><?= number_format($total, 2) ?></b></td>
        <td bgcolor='#CEE7FF'></td>
      </tr>
    <?php
    }
    ?>
  </table>
  <p align="right">
    <!-- <a href="list_l.php" class="btn btn-info">กลับหน้ารายการสินค้า</a> -->
    <!-- <a href="#" target="" class="btn btn-success" onclick="window.print()">Print</a> -->

    <input type="submit" name="button" id="button" value="ปรับปรุง" class="btn btn-warning" />
    <input type="button" name="Submit2" value="ทำรายการต่อไป" onclick="window.location='confirm_a.php';" class="btn btn-primary" />

    <!-- <input type="hidden" name="t_id" value="<?php echo $t_id; ?>"> -->
    <!-- <input type="hidden" name="b_id" value="<?php echo $b_id; ?>"> -->
  </p>
</form>