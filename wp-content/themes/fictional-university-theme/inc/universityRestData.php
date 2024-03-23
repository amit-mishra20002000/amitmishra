<?php
    add_action( 'rest_api_init', function () {
        register_rest_route( 'university/v1', 'search', array(
          'methods' => WP_REST_SERVER::READABLE,
          'callback' => 'universityCustomData',
        ) );
      } );
    
      function universityCustomData($data){
        $mainQuery = new WP_Query(array(
            'post_type' => array('post','page','event','program','event','professor'),
            's' => sanitize_text_field($data['term'])
        ));
        $results = array(
            'generalInfo' => array(),
            'event' => array(),
            'program' => array(),
            'professor' => array()
        );
        while($mainQuery->have_posts()){
            $mainQuery->the_post();
            if(get_post_type() == 'post' OR get_post_type() == 'page'){
                array_push($results['generalInfo'], array(
                    'title' => get_the_title(),
                    'link' => get_the_permalink(),
                    'authorName' => get_the_author(),
                    'type' => get_post_type()
                ));
            }
            if(get_post_type() == 'event'){

                $time = strtotime(get_field('event_date'));
                $event_month = date("M",$time);
                $event_date = date("j",$time);

                $description = null;

                if(has_excerpt()){
                    $description = get_the_excerpt();
                }else{
                    $description = wp_trim_words( get_the_content(), 10, '...' );
                }
                      

                array_push($results['event'], array(
                    'title' => get_the_title(),
                    'link' => get_the_permalink(),
                    'event_month' => $event_month,
                    'event_date' => $event_date,
                    'description' => $description
                ));
            }
            if(get_post_type() == 'program'){
                array_push($results['program'], array(
                    'title' => get_the_title(),
                    'link' => get_the_permalink(),
                    'id' => get_the_ID()
                ));
            }
            if(get_post_type() == 'professor'){
                array_push($results['professor'], array(
                    'title' => get_the_title(),
                    'link' => get_the_permalink(),
                    'image' => get_the_post_thumbnail_url(0,'professorLandscspe')
                ));
            }
        }

        if($results['program']){

            $programMetaQuery = array('relation' => 'OR');
            foreach($results['program'] as $item){
                array_push($programMetaQuery,
                    array(
                        'key' => 'related_programs',
                        'compare' => 'LIKE',
                        'value' => '"'.$item['id'].'"'
                    )
                );
            }

            $programRelatedQuery = new WP_Query(
                array(
                    'post_type' => array('event','professor'),
                    'meta_query' => $programMetaQuery
                )
            );
        
            while($programRelatedQuery->have_posts()){
                $programRelatedQuery->the_post();
                
                if(get_post_type() == 'professor'){
                    array_push($results['professor'], array(
                        'title' => get_the_title(),
                        'link' => get_the_permalink(),
                        'image' => get_the_post_thumbnail_url(0,'professorLandscspe')
                    ));
                }
                if(get_post_type() == 'event'){

                    $time = strtotime(get_field('event_date'));
                    $event_month = date("M",$time);
                    $event_date = date("j",$time);
    
                    $description = null;
    
                    if(has_excerpt()){
                        $description = get_the_excerpt();
                    }else{
                        $description = wp_trim_words( get_the_content(), 10, '...' );
                    }
                          
    
                    array_push($results['event'], array(
                        'title' => get_the_title(),
                        'link' => get_the_permalink(),
                        'event_month' => $event_month,
                        'event_date' => $event_date,
                        'description' => $description
                    ));
                }

            }
        }
        $results['professor'] = array_values(array_unique($results['professor'],SORT_REGULAR));
        $results['event'] = array_values(array_unique($results['event'],SORT_REGULAR));
        return $results;
      }
?>