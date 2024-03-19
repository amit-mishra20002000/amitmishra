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
            's' => $data['term']
        ));
        $results = array(
            'generalInfo' => array(),
            'event' => array(),
            'program' => array(),
            'event' => array(),
            'professor' => array()
        );
        while($mainQuery->have_posts()){
            $mainQuery->the_post();
            if(get_post_type() == 'post' OR get_post_type() == 'page'){
                array_push($results['generalInfo'], array(
                    'title' => get_the_title(),
                    'link' => get_the_permalink()
                ));
            }
            if(get_post_type() == 'event'){
                array_push($results['event'], array(
                    'title' => get_the_title(),
                    'link' => get_the_permalink()
                ));
            }
            if(get_post_type() == 'program'){
                array_push($results['program'], array(
                    'title' => get_the_title(),
                    'link' => get_the_permalink()
                ));
            }
            if(get_post_type() == 'event'){
                array_push($results['event'], array(
                    'title' => get_the_title(),
                    'link' => get_the_permalink()
                ));
            }
            if(get_post_type() == 'professor'){
                array_push($results['professor'], array(
                    'title' => get_the_title(),
                    'link' => get_the_permalink()
                ));
            }
            
        }
        return $results;
      }
?>