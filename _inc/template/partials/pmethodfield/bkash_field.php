<div class="panel panel-default mt-5">
	<div class="panel-body">
		<div class="form-group">
			<label for="bkash_trx_id" class="col-sm-4 control-label">
				Metodos De Pago
			</label>
			<div class="col-sm-8">
				<select id="bkash_trx_id" class="form-control" name="payment_details[Metodo_Pago]">
					<option value="Tarjeta Credito" selected>Tarjeta Credito</option>
					<option value="Tarjeta Debito">Tarjeta Debito</option>
					<option value="Transferencia">Transferencia</option>
					<option value="Nequi">Nequi</option>
					<option value="Otro">Otro</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="bkash_phone_no" class="col-sm-4 control-label">
				ID/Nota
			</label>
			<div class="col-sm-8">
				<input type="text" id="bkash_phone_no" name="payment_details_id[id_nota]" placeholder="# transaccion / Nota" class="form-control" autocomplete="off">
			</div>
		</div>
	</div>
</div>


