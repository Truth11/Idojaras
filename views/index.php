<div class="row justify-content-center content-top mt-5 content-bottom">
	<div class="col-md-8 mx-auto text-center">
		<div class="container">
			<div class="row">
				<form action="#" method="POST" class="shadow form-control">
					<div class="col-md-6 float-start">
						<div class="form-group">											
							<label for="select1">Country</label>  
							<select id="country" name="country" class="form-select text-center">
								<option value="Japan">Japan</option>
								<option value="Hungary">Hungary</option>
								<option value="United States">United States</option>			
							</select>
						</div>
					</div>
					<div class="col-md-6 float-end">
						<div class="form-group">
							<label for="select2">City</label>
							<select id="city" name="city" class="form-select text-center">
								<option value="Tokyo">Tokyo</option>
								<option value="Budapest">Budapest</option>						
								<option value="New York">New York</option>			
							</select>
						</div>
					</div>					
					<button class="btn btn-outline-info mt-3 mb-2" type="submit" id="sbmt-button">Lekérdezés</button>
				</form>
			</div>		
		</div>
	</div>
</div>
	<div class="col-md-8 mx-auto mt-3 text-center"<?php echo $hidden; ?>>
		<div class="col-md-3 rounded-pill shadow p-4 mx-auto">
			<p class="h4">Jelenleg:</p>
			<h1><span id="temp"><?php echo $temp_value; ?></span> °C</h1>
		</div>
	</div>
	<div class="col-md-8 mx-auto mt-3 text-center">
	<div id="chartContainer" style="height: 370px; width: 100%;" <?php echo $hidden; ?>></div>
	</div>
	<div class="col-md-8 mx-auto mt-3 text-center">
	<!-- cron intervallum módosításának helye-->
	<form action="#" method="POST" class="shadow form-control">
	<input type="number" id="cron" name="cron" min="1" max="10">
	<button class="btn btn-outline-secondary mt-3 mb-2" type="submit" id="sbmt-button">Módosítás</button>
	</form>
	</div>
	