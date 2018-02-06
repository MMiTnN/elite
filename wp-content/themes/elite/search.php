<?php
get_header();

?>

<div class="title text-dark-grey text-center container no-padding">
    <?php printf(__('search results for: %s', ''), get_search_query()); ?>
</div>

<section class="header-section">
    <div>
        <p class='text-white header-title text-center'>Find a camp</p>
    </div>
</section>

<section class="search-result">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3 col-xs-12 search">
				<div class="block black">
					<h4>Select dates</h4>
					<div class="select-box dropdown">
		                <select name="filter_date" id="filter_date" class="select-box">
		                    <option value="">All period</option>
		                </select>
		            </div>
				</div>
				<div class="block black">
					<h4>Select age range</h4>
					<div class="select-box multiple">
			            <label class="checkbox-inline">7-9 years
						  <input type="checkbox">
						  <span class="checkmark"></span>
						</label>
						<label class="checkbox-inline">10-12 years
						  <input type="checkbox">
						  <span class="checkmark"></span>
						</label>
						<label class="checkbox-inline">13-15 years
						  <input type="checkbox">
						  <span class="checkmark"></span>
						</label>
		            </div>
				</div>
				<div class="block black">
					<h4>Select camp type</h4>
					<div class="select-box multiple">
			            <label class="checkbox-inline">Mountainbiking
						  <input type="radio" name="acttype">
						  <span class="checkmark circle"></span>
						</label>
						<label class="checkbox-inline">Outdoor adventure 
						  <input type="radio" name="acttype">
						  <span class="checkmark circle"></span>
						</label>
						<label class="checkbox-inline">Water based
						  <input type="radio" name="acttype">
						  <span class="checkmark circle"></span>
						</label>
						<label class="checkbox-inline">Outdoor adventure 
						  <input type="radio" name="acttype"accept="">
						  <span class="checkmark circle"></span>
						</label>
						<label class="checkbox-inline">Water based
						  <input type="radio" name="acttype">
						  <span class="checkmark circle"></span>
						</label>
		            </div>
				</div>
			</div>
			<div class="col-md-9 col-xs-12 search camp-item">
				<div class="item-camp col-xs-12">
					<div class="col-sm-4 col-xs-12 camp-item-contrainer left">
						<div class="block bg-gold">
							<h3 class="text-white">Outdoor Discover</h3>
							<h4 class="text-white">Age: 7-9</h4>
						</div>
					</div>
					<div class="col-sm-8 col-xs-12 camp-item-contrainer right">
						<div class="block bg-gray">
							<ul>
								<li>
									Perfect introduction to the outdoors
								</li>
								<li>
									Learn outdoor skills
								</li>
								<li>
									Adventure packed with many activities
								</li>

							</ul>
							<div class="bottom-content">
								<div class="content-bot">
									<span class="glyphicon glyphicon-tag"> </span>
									 Price: 20500 THB
								</div>
								<div class="content-bot">
									<a href="">learn more</a>
								</div>
							</div>
						</div>
					</div>	
				</div>
				<div class="item-camp col-xs-12">
					<div class="col-sm-4 col-xs-12 camp-item-contrainer left">
						<div class="block bg-gold">
							<h3 class="text-white">Outdoor Discover </h3>
							<h4 class="text-white">Age: 10-12</h4>
						</div>
					</div>
					<div class="col-sm-8 col-xs-12 camp-item-contrainer right">
						<div class="block bg-gray">
							<ul>
								<li>
									Perfect introduction to the outdoors
								</li>
								<li>
									Learn outdoor skills
								</li>
								<li>
									Adventure packed with many activities
								</li>

							</ul>
							<div class="bottom-content">
								<div class="content-bot">
									<span class="glyphicon glyphicon-tag"> </span>
									 Price: 20500 THB
								</div>
								<div class="content-bot">
									<a href="">learn more</a>
								</div>
							</div>
						</div>
					</div>	
				</div>
				<div class="item-camp col-xs-12">
					<div class="col-sm-4 col-xs-12 camp-item-contrainer left">
						<div class="block bg-gold">
							<h3 class="text-white">Outdoor Discover</h3>
							<h4 class="text-white">Age: 13-15</h4>
						</div>
					</div>
					<div class="col-sm-8 col-xs-12 camp-item-contrainer right">
						<div class="block bg-gray">
							<ul>
								<li>
									Perfect introduction to the outdoors
								</li>
								<li>
									Learn outdoor skills
								</li>
								<li>
									Adventure packed with many activities
								</li>
							</ul>
							<div class="bottom-content">
								<div class="content-bot">
									<span class="glyphicon glyphicon-tag"> </span>
									 Price: 20500 THB
								</div>
								<div class="content-bot">
									<a href="">learn more</a>
								</div>
							</div>
						</div>
					</div>	
				</div>				
			</div>

		</div>
	</div>
</section>

<section class="">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
        }
    }
    ?>
</section>
            
</footer>
    <?php get_footer(); ?>
