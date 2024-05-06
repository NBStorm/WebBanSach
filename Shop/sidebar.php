<div id="sidebar" class="col-md-4">
					<div class="widget wid-categories">
						<div class="heading"><h4>Thể loại</h4></div>
						<div class="content">
							<ul>
							<?php
   require 'inc/myconnect.php';
   //lay san pham theo id
   $layidrandom="SELECT MaTL,TenTL  from theloai" ;
   $kq = $conn->query($layidrandom);
   if ($kq ->num_rows > 0) {
	// output data of each row
	while($d = $kq ->fetch_assoc()) {

?>
								<li><a href="category.php?manhasx=<?php echo $d["MaTL"] ?>"><?php echo $d["TenTL"] ?></a></li>
								<?php
	}
}
								 ?>
							</ul>
						</div>
					</div>
					
						<?php

							?>
						</div>
					</div>
				</div>