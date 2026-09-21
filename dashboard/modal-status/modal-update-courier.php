<?php 
			$consulta_mysql="SELECT cid,cons_no,ship_name,phone,correo
			FROM courier 
			WHERE  cid=cid";
			$resultado_consulta_mysql=mysql_query($consulta_mysql);	
			while($row=mysql_fetch_array($resultado_consulta_mysql)){											
			?>	
		  <div id="con-close-modal<?php echo $row['cid']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">				
					<div class="modal-content">
					<form action="settings/add_courier/update_status.php" method="post" name="frmShipment" id="frmShipment">
						<div class="modal-header"> 
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
							<h3 class="modal-title"><?php echo $actualizarestadoenvio; ?></h3> 
						</div> 
						<div class="modal-body">
							<div class="row"  style="display:none">  
								<div class="col-md-2"> 
									<div class="form-group">
									<label for="field-5" class="control-label"><?php echo $ids; ?></label> 									
										<input type="text" class="form-control" id="field-5" name="cid" value="<?php echo $row['cid']; ?>" readonly > 
									</div> 
								</div> 
								<div class="col-md-4"> 
									<div class="form-group"> 
										<label for="field-6" class="control-label"><?php echo $tracking; ?></label> 
										<input type="text" class="form-control" id="field-6" name="cons_no" value="<?php echo $row['cons_no']; ?>" readonly> 
									</div> 
								</div>
								<div class="col-md-6"> 
									<div class="form-group"> 
										<label for="field-6" class="control-label"><?php echo $Usuario; ?></label> 
										<input type="text" class="form-control" id="field-6" name="user" value="<?php echo $_SESSION['user_name'] ;?>" readonly> 
									</div> 
								</div>								
								<div class="col-md-6"> 
									<div class="form-group"> 
										<label for="field-6" class="control-label"><?php echo $Usuario; ?></label> 
										<input type="text" class="form-control" id="field-6" name="phone" value="<?php echo $row['phone'] ;?>" readonly> 
									</div> 
								</div>								
							</div>
							<div class="row"  style="display:none">  								
								<div class="col-md-6"> 
									<div class="form-group"> 
										<label for="field-6" class="control-label"><?php echo $destina; ?></label> 
										<input type="text" class="form-control" id="field-6" name="ship_name" value="<?php echo $row['ship_name']; ?>" readonly> 
									</div> 
								</div>
								<div class="col-md-6"> 
									<div class="form-group"> 
										<label for="field-6" class="control-label"><?php echo $EMAIL; ?></label> 
										<input type="text" class="form-control" id="field-6" name="correo" value="<?php echo $row['correo'] ;?>" readonly> 
									</div> 
								</div> 								
							</div> 
							<div class="row"> 
								<div class="col-md-6"> 
									<div class="form-group"> 
										<label for="field-1" class="control-label"><?php echo $NUEVAUBICACION; ?></label> 

										<select name="pick_time"  class="form-control">
										<?php
											$sql=mysql_query("SELECT country_id,country_name FROM countries ORDER BY country_name");
											while($row=mysql_fetch_array($sql)){
												echo '<option value="'.$row["country_name"].'">'.$row["country_name"].'</option>';
											}
										?>
									</select>
									</div> 
								</div> 
								<div class="col-md-6"> 
									<div class="form-group"> 
										<label for="field-6" class="control-label"><?php echo $L_CITYADDRESS; ?></label> 
										<input type="text" class="form-control" id="field-6" name="citaddress" placeholder="<?php echo $L_CITYADDRESS_COMMENTS; ?>" > 
									</div> 
								</div>
							</div>
							<div class="row"> 
								<div class="col-md-6"> 
									<div class="form-group"> 
										<label for="field-2" class="control-label"><?php echo $NUEVOESTADO; ?></label> 
										<select name="status" class="form-control" >
												<?php
														$sql=mysql_query("SELECT servicemode FROM service_mode  GROUP BY servicemode");
														while($row=mysql_fetch_array($sql)){
														if($cliente==$row['servicemode']){
														echo '<option value="'.$row['servicemode'].'" selected>'.$row['servicemode'].'</option>';
														}else{
														echo '<option value="'.$row['servicemode'].'">'.$row['servicemode'].'</option>';
													 }
													}
												?>
											</select>
									</div> 
								</div> 
							</div> 
							<div class="row"> 
								<div class="col-md-12"> 
									<div class="form-group"> 
										<label for="field-3" class="control-label"><?php echo $COMENTARIOS; ?></label> 
										<textarea class="form-control" name="comments" id="comments"  placeholder="<?php echo $cometario_estado; ?>" required></textarea> 
									</div> 
								</div> 
							</div>  
						</div> 
						<div class="modal-footer"> 
							<button type="button" class="btn btn-white" data-dismiss="modal"><?php echo $cerrar; ?></button> 
							<input name="submit" type="submit" class="btn btn-info" value="<?php echo $ACTUALIZARESTADO; ?>">
						</div>
					</form>	
					</div>				
				</div>
			</div><!-- /.modal -->
			<?php } ?>
