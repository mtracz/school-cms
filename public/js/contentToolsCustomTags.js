var __hasProp={}.hasOwnProperty,__extends=function(o,n){function t(){this.constructor=o}for(var e in n)__hasProp.call(n,e)&&(o[e]=n[e]);return t.prototype=n.prototype,o.prototype=new t,o.__super__=n.prototype,o};ContentTools.Tools.Underline=function(o){function n(){return n.__super__.constructor.apply(this,arguments)}return __extends(n,o),ContentTools.ToolShelf.stow(n,"underline"),n.label="Underline",n.icon="underline",n.tagName="u",n}(ContentTools.Tools.Bold),ContentTools.DEFAULT_TOOLS.unshift(["underline"]);