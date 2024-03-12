import $ from "jquery"

class Search {
  // 1. describe and create/initiate our object
  constructor() {
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
        
            this.findTextTerm = setTimeout(this.getResults.bind(this), 2000)
        }else{
            this.searchResults.html('');
            this.isSpinnerVisible = false;
        }
        
    
    }
    this.previousValue = this.searchTerm.val();
  }
  getResults(){
    this.searchResults.html('This is output');
    this.isSpinnerVisible = false;
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
    this.searchOverlay.addClass("search-overlay--active")
    $("body").addClass("body-no-scroll")
  }

  closeOverlay() {
    this.isOverlayOpen = false
    this.searchOverlay.removeClass("search-overlay--active")
    $("body").removeClass("body-no-scroll")
  }
}

export default Search
