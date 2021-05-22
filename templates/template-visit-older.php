<?php 
/**
 * Template Name: Visit - Event
 *
 * This is the template that displays Visit-Event pages.
 *
 * @link https://codex.wordpress.org/Theme_Development#Custom_Page_Templates
 * @package Venet
 */
?>
<?php get_header(); ?>	
	    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p class="push h60"></p>
                
                <div class="component title">
                   <h1><?php the_title(); ?></h1>
                </div>
                
                <?php if ( $standfirst = get_field( 'standfirst_text' ) ) : ?>
                    <div class="component standfirst">
                        <?php echo $standfirst; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                <div class="component button">
                    <a href="#">Lorem ipsum dolor</a>
                </div>
                <div class="component event">
                    <h2>Lorem ipsum dolor sit amet, consectetur adipiscing</h2>
                    <h3>July 20th 2016 @ 11:00 - 2:30</h3>
                    <div class="component bodycopy">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                    
                    <form>
                        <div class="row">
                            <div class="col-xs-12 col-sm-4">
                                <label>Number of guests</label>
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <select>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>

                            <div class="col-xs-12 col-sm-4">
                                <p class="number"><span>18</span> spaces left on course</p>
                            </div>
                        </div>
                        <p class="push h20"></p>
                        
                        <div class="row">
                            <div class="col-xs-12 col-sm-4">
                                <label>Total</label>
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <p class="total">£120</p>
                            </div>
                        </div>
                    </form>
                    
                    <p class="push h20"></p>
                    
                    <div class="component button">
                        <a href="#">Lorem ipsum dolor</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="bg-white">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="push h80"></div>
                    <div class="component subtitle">
                        <h2>Lorem ipsum dolor</h2>
                    </div>
                    <div class="push h60"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="component bodycopy">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="component image">
                        <figure>
                            <img src="HTMLResources/img/image.png" alt="Image description" />
                        </figure>
                    </div>

                </div>
                <div class="push h80"></div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="push h80"></div>
                <div class="component subtitle">
                    <h2><?php the_field( 'title' ); ?></h2>
                </div>
                <div class="push h60"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="component list">
                    <div class="row">
                        <!-- Displaying Left Side Q&A set -->
                        <?php if ( have_rows( 'left_side_question_set' ) ) : ?>
                            <ul class="col-sm-12 col-sm-6">
                                <?php while( have_rows( 'left_side_question_set' ) ): the_row(); ?>
                                    <li>
                                        <span>Q. <?php the_sub_field( 'question' ); ?></span>
                                        <span class="answer">A. <?php the_sub_field( 'answer' ); ?></span>
                                    </li>         
                                <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>
                        <!-- Displaying Right Side Q&A set -->
                        <?php if ( have_rows( 'right_side_question_set' ) ) : ?>
                            <ul class="col-sm-12 col-sm-6">
                                <?php while( have_rows( 'right_side_question_set' ) ): the_row(); ?>
                                    <li>
                                        <span>Q. <?php the_sub_field( 'question' ); ?></span>
                                        <span class="answer">A. <?php the_sub_field( 'answer' ); ?></span>
                                    </li>         
                                <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="push-sf"></div> <!-- for sticky footer -->
</div><!-- .wrapper -->
<?php get_footer(); ?>	