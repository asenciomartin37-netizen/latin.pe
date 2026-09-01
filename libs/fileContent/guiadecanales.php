<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image:url(images/resources/reds-bg.jpg);">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="inner-content text-center clearfix">
					<div class="breadcrumb-menu">
						<ul class="clearfix">
							<li><a href="<?php info('url');?>">Inicio</a>
							</li>
							<li class="active">Guía de canales</li>
						</ul>
					</div>
					<div class="title">
						<h1>Guía de canales</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--End breadcrumb area-->

<section class="speed-area">
	<div class="container">
		<div class="row">
			<div class="col-xl-12 col-lg-12">
				<div class="speed-content-box">
					<div class="sec-title">
						<div class="title">Canales Analogicos</div>
					</div>
					<div class="inner-content">

						<div id="channels">
							<ul>
                                <?php canales_analogicos('Analogico');?>
							</ul>
						</div>
					</div>
					<div class="clear"></div>
					<div class="inner-content">
						<div class="sec-title">
							<div class="title">Canales Digitales</div>
						</div>

						<div id="channels">
							<ul>
                                <?php canales_analogicos('Digital');?>
							</ul>
						</div>


					</div>
				</div>
			</div>
		</div>
	</div>
</section>