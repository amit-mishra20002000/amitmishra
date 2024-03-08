<div class="event-summary">
                <?php 
                  $time = strtotime(get_field('event_date'));
                  $event_month = date("M",$time);
                  $event_date = date("j",$time);
                ?>
                <a class="event-summary__date t-center" href="#">
                  <span class="event-summary__month"><?php echo $event_month; ?></span>
                  <span class="event-summary__day"><?php echo $event_date; ?></span>
                </a>
                <div class="event-summary__content">
                  <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h5>
                  <p>
                    <?php 
                        if(has_excerpt()){
                          echo get_the_excerpt();
                        }else{
                          echo wp_trim_words( get_the_content(), 10, '...' );
                        }
                     ?> 
                    <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a>
                  </p>
                </div>
              </div>