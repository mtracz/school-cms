// CoffeeScript helpers
var __hasProp = {}.hasOwnProperty;
var __extends = function(child, parent) {
    for (var key in parent) {
        if (__hasProp.call(parent, key)) 
            child[key] = parent[key];
    }

    function ctor() { 
        this.constructor = child; 
    }

    ctor.prototype = parent.prototype;

    child.prototype = new ctor();
    child.__super__ = parent.prototype; 

    return child; 
};

ContentTools.Tools.Underline = (function(_super) {
    __extends(Underline, _super);

    // This class extends the existing Bold tool    
    function Underline() {
      return Underline.__super__.constructor.apply(this, arguments);
    }

    // Stow the tool so we can reference it later using 'sup'
    ContentTools.ToolShelf.stow(Underline, 'underline');

    // Set the tool tip that will appear
    Underline.label = 'Underline';

    // Set the name of the icon (this wont exist unless you add one)
    Underline.icon = 'underline';

    // Set the tag that will be used to wrap content when pressing this tool
    Underline.tagName = 'u';

    return Underline;

})(ContentTools.Tools.Bold);

// Add the new `Sup` tool in it's own group to the toolbox
ContentTools.DEFAULT_TOOLS.unshift(['underline']);
