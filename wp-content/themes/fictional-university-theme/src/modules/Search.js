import $ from "jquery"

class Search {
  // 1. describe and create/initiate our object
  constructor() {
    this.addSearchHTML();
    this.searchResults = $("#search-overlay__results");
    this.openButton = $(".js-search-trigger")
    this.closeButton = $(".search-overlay__close")
    this.searchOverlay = $(".search-overlay")
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
    this.searchTerm = $("#search-term");
    this.findTextTerm;
    this.previousValue;
    this.events()
  }

  // 2. events
  events() {
    this.openButton.on("click", this.openOverlay.bind(this))
    this.closeButton.on("click", this.closeOverlay.bind(this))
    $(document).on("keyup", this.keyPressDispatcher.bind(this))
    this.searchTerm.on("keyup", this.findSearchTerm.bind(this))
  }

  // 3. methods (function, action...)
  findSearchTerm(){
    
    if(this.searchTerm.val() != this.previousValue){
        clearTimeout(this.findTextTerm);
        if(this.searchTerm.val()){
            if(!this.isSpinnerVisible){
                this.searchResults.html('<div class="spinner-loader"></div>');
                this.isSpinnerVisible = true;
            }
        
            this.findTextTerm = setTimeout(this.getResults.bind(this), 750)
        }else{
            this.searchResults.html('');
            this.isSpinnerVisible = false;
        }
        
    
    }
    this.previousValue = this.searchTerm.val();
  }
  getResults(){
    //Asynchronous
    $.when(
      $.getJSON(universityData.root_url+"/wp-json/wp/v2/posts?search="+this.searchTerm.val()),
      $.getJSON(universityData.root_url+"/wp-json/wp/v2/pages?search="+this.searchTerm.val()),
      $.getJSON(universityData.root_url+"/wp-json/wp/v2/event?search="+this.searchTerm.val())
    ).then(
      (posts, pages, event) => {
        const combineResults = posts[0].concat(pages[0],event[0]);
        this.searchResults.html(`<h2 class="search-overlay__section-title">General Information</h2></h2>
            ${combineResults.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search.</p>'}
            ${combineResults.map( item => `<li><a href="${item.link}">${item.title.rendered}</a> ${item.type == 'post' ? `by ${item.authotName}`: ' ' }</li>`).join("")}
            ${combineResults.length ? '</ul>' : ''}
          `)
          this.isSpinnerVisible = false;
      }, () => { this.searchResults.html('<p>Unexcepted error, Please try again !!!!!</p>') })
      
    //Synchronous
    // $.getJSON(universityData.root_url+"/wp-json/wp/v2/posts?search="+this.searchTerm.val(),(posts) => {
    //   $.getJSON(universityData.root_url+"/wp-json/wp/v2/pages?search="+this.searchTerm.val(),(pages) => {
    //     $.getJSON(universityData.root_url+"/wp-json/wp/v2/event?search="+this.searchTerm.val(),(event) => {
    //       const combineResults = posts.concat(event,pages);
    //       this.searchResults.html(`<h2 class="search-overlay__section-title">General Information</h2></h2>
    //         ${combineResults.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search.</p>'}
    //         ${combineResults.map( item => `<li><a href="${item.link}">${item.title.rendered}</a></li>`).join("")}
    //         ${combineResults.length ? '</ul>' : ''}
    //       `)
    //       this.isSpinnerVisible = false;
    //     })
    //   })
    // })
    
  }

  keyPressDispatcher(e) {
    if (e.keyCode == 83 && !this.isOverlayOpen && !$("input, textarea").is(":focus")) {
        //console.log(e.keyCode );
        this.openOverlay()
    }

    if (e.keyCode == 27 && this.isOverlayOpen && !$("input, textarea").is(":focus")) {
      this.closeOverlay()
    }
  }

  openOverlay() {
    this.isOverlayOpen = true;
    this.searchOverlay.addClass("search-overlay--active");
    setTimeout(() => {
      this.searchTerm.focus(); 
    }, 310);
    
    $("body").addClass("body-no-scroll")
  }

  closeOverlay() {
    this.isOverlayOpen = false
    this.searchOverlay.removeClass("search-overlay--active")
    this.searchTerm.val('');
    this.searchResults.html('');
    $("body").removeClass("body-no-scroll")
  }
  addSearchHTML() {
    $("body").append(`
      <div class="search-overlay">
        <div class="search-overlay__top">
          <div class="container">
            <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
            <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">
            <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
          </div>
        </div>
        
        <div class="container">
          <div id="search-overlay__results"></div>
        </div>

      </div>
    `)
  }
}

export default Search
