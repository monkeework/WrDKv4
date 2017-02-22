<?php





















//NEW MODAL FUNCTIONNS HERE
//NEW MODAL FUNCTIONNS HERE
//NEW MODAL FUNCTIONNS HERE

function gt_modalGallery(){

	if($modal){
	// look at the image url properly
	//left  equals image index minus one - right image index plus one
	// on first image is 0 - if you get minu one, need logic to set end/last of index which is
	//length minus one -- due lenght
	$str .= '




							<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

								<div class="modal-dialog modal-lg w500" >

									<div class="modal-content">';


						$str .= mk_modalCarouselimgs();

						$str .=	'<!-- Controls -->
										<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
												<span class="glyphicon glyphicon-chevron-left"></span>
										</a>

										<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
												<span class="glyphicon glyphicon-chevron-right"></span>
										</a>

									</div><!-- END carousel-example-generic -->

								</div><!-- Modal-content --></div>
							</div>

						</div><!-- modal fade bs-example-modal-lg--></div>

					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div><!--END IMAGES-->
	</div>';
	} //END Modal Image Gallery
}

function gt_modalImg(){}



function mk_modalCarouselimgs(){
	$str .= '<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<!-- Wrapper for slides -->

		<div class="carousel-inner"><div class="item active">
			<img class="img-responsive" src="./28/28-13.jpg" alt="...">
			<div class="carousel-caption"><strong>
				Scarlet Witch</strong> (1/20)
			</div>
		</div>

		<div class="item ">
			<img class="img-responsive" src="./28/28-1.jpg" alt="...">
			<div class="carousel-caption"><strong>Scarlet Witch</strong> (2/20)</div>
		</div>

		<div class="item ">
			<img class="img-responsive" src="./28/28-2.jpg" alt="...">
			<div class="carousel-caption"><strong>Scarlet Witch</strong> (3/20)</div>
		</div>

		<div class="item ">
			<img class="img-responsive" src="./28/28-3.jpg" alt="...">
			<div class="carousel-caption"><strong>Scarlet Witch</strong> (4/20)</div>
		</div>

		<div class="item ">
			<img class="img-responsive" src="./28/28-4.jpg" alt="...">
			<div class="carousel-caption"><strong>Scarlet Witch</strong> (5/20)</div>
		</div>

		<div class="item ">
			<img class="img-responsive" src="./28/28-5.jpg" alt="...">
			<div class="carousel-caption"><strong>Scarlet Witch</strong> (6/20)</div>
		</div>

		<div class="item ">
			<img class="img-responsive" src="./28/28-6.jpg" alt="...">
			<div class="carousel-caption"><strong>Scarlet Witch</strong> (7/20)</div>
		</div>

		<div class="item ">
			<img class="img-responsive" src="./28/28-7.jpg" alt="...">
			<div class="carousel-caption"><strong>Scarlet Witch</strong> (8/20)</div>
		</div>

		<div class="item ">
			<img class="img-responsive" src="./28/28-8.jpg" alt="...">
			<div class="carousel-caption"><strong>Scarlet Witch</strong> (9/20)</div>
		</div>

		<div class="item ">
			<img class="img-responsive" src="./28/28-9.jpg" alt="...">
			<div class="carousel-caption"><strong>Scarlet Witch</strong> (10/20)</div>
		</div>

		<div class="item ">
			<img class="img-responsive" src="./28/28-10.jpg" alt="...">
			<div class="carousel-caption"><strong>Scarlet Witch</strong> (11/20)</div>
		</div>

	</div>';
	return $str; // return modal gallery
}

//NEW MODAL FUNCTIONNS HERE
//NEW MODAL FUNCTIONNS HERE
//NEW MODAL FUNCTIONNS HERE















































