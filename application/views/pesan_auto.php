		<br>
		<br>
		<br>
		<div class="card">
			<div class="card-block">
				<!-- header -->
				<div class="form-header">
					<center>
						<h3>Tekan untuk aktivkan sms auto reply!</h3>
					</center>
				</div>
				<br>
				<div class="col-md-12">
                    <div class="text-xs-center">
                        <a id="auto-sms" href="<?php echo site_url('Csms/view_full_auto_sms')?>" target='_blank'>
		                    <button class="btn btn-primary btn-block"><h3><< Aktifkan >></h3></button>
		                </a>
                    </div>
                </div>
			</div>
		</div>

        <script type="text/javascript">
        	$('#auto-sms').click(function(event) {
		        event.preventDefault();
		        window.open($(this).attr("href"), "popupWindow", "width=600,height=600,scrollbars=yes");

		        setTimeout(function(){
		            if (window.opener.closed)
		            //alert("You killed my boss!")
		                console.log('die')
		            else
		                console.log('live')
		            //alert("My boss is still alive!")

		        },5000)
		    });
        </script>