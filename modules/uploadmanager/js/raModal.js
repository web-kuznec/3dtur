/*
28.03.2011
Rah
	
*/
var modalW;
window.addEvent('domready', function() {
	modalW = new raModal({
		divBlockID: 'bzz',
		divModalID: 'divVideoForm',
		theme: ''
	});
});

var raModal = new Class({
	
	Implements: [Options,Events],

	options: {
		divBlock : null,
		divModal : null,
		imgLoader : null,
		divToUpdate : null,
		divBlockID : '',
		divModalID : '',
		zIndex: 5000,
		container: null,
		h: 0,
		mt: 0
	},
	initialize: function(options) {
		this.setOptions(options);
		this.createElements();
	},
	
	createElements: function() {
		this.options.h = window.getSize().y;
		this.options.w = window.getSize().x;
		this.options.mt = window.getScroll().y;	
		this.options.ml = window.getScroll().x;	
		
		var _ths = this;
		if(!this.options.container){
			this.options.container = $$('body')[0];
		}
		var b = new Element('div',{
			id: this.options.divBlockID,
			'class':'modal-full'
		});
		b.setStyles({
			zIndex: this.options.zIndex,
			opacity: 0,
			visibility: 'hidden',
			display: 'none'
		});
		
		var o = new Element('div',{
			'class':'modal-o'
		});
		o.setStyles({
			opacity: 0,
			visibility: 'hidden',
			display: 'none',
			zIndex: this.options.zIndex,
		});
		var l = new Element('img',{
			src: ''
		});
		var c = new Element('span',{
			html: '&times;',
			'class': 'modal-close',
			events:{
				click: function(){
					_ths.close();
				}
			}
		});

		l.setStyles({
			position: 'absolute',
			top: '50%',
		});
		var m = new Element('div',{
			'class':'modal-w hide'
		});
		m.setStyles({
			zIndex: this.options.zIndex,
			opacity: 0,
			visibility: 'hidden',
		});
		var d = new Element('div',{
			id: this.options.divModalID,
			align: 'left',
			'class': 'modal-in'
		});

		
		o.inject(this.options.container);
		b.inject(this.options.container);
		m.inject(b);
		
		this.options.divBlock = b;
		this.options.divModal = m;
		this.options.imgLoader = l;
		this.options.divOpacity = o;
		this.options.divToUpdate = d;
		
		l.inject(b);
		c.inject(m);
		d.inject(m);
	
	},
	unShowLoader: function() {
		m = this.options.divModal;
		l = this.options.imgLoader;
		
		m.removeClass('hide');
		l.setStyle('visibility','hidden');
		m.fade('in');
	},
	ShowLoader: function() {
		b = this.options.divBlock;
		o = this.options.divOpacity;
		m = this.options.divModal;
		l = this.options.imgLoader;
		this.options.h = window.getSize().y;
		this.options.w = window.getSize().x;
		this.options.mt = window.getScroll().y;	
		this.options.ml = window.getScroll().x;	
		var h = this.options.h;
		var w = this.options.w;
		var mt = this.options.mt;
		var ml = this.options.ml;
		
		// this.options.container.setStyles({height: h+mt-2, marginTop: -mt, marginLeft: -ml,width:w, overflow: 'hidden'});
		
		
		
		l.setStyle('visibility','visible');
		
		m.addClass('hide');
		
		b.setStyle('display','block');
		b.setStyle('visibility','visible');
		m.setStyle('visibility','visible');
		b.fade('in');
		
		o.setStyle('display','block');
		o.fade(0.3);
		
	},
	close : function() {
		
		b = this.options.divBlock;
		o = this.options.divOpacity;
		
		b.fade('out');
		b.setStyle('display','none');
		o.fade('out');
		o.setStyle('display','none');

		
		// this.options.container.setStyles({marginTop: 0,height: 'auto', overflow: 'auto'});

		window.scrollTo(this.options.ml,this.options.mt);
		
		this.options.h = window.getSize().y;
		this.options.w = window.getSize().x;
		this.options.mt = window.getScroll().y;	
		this.options.ml = window.getScroll().x;
		this.fireEvent('close');
	},
	get: function(){
		return this.options.divToUpdate;
	},
	show: function(){
		this.ShowLoader();
		this.unShowLoader();
	}
});
function unShowLoader(){
	if(modalW && instanceOf(modalW,raModal))
		modalW.unShowLoader();
}
function showLoader(){
	if(modalW && instanceOf(modalW,raModal))
		modalW.ShowLoader();
}
function getModalW(){
	if(modalW && instanceOf(modalW,raModal)){
		return modalW.get();
	}
}
function closeModalW(){
	if(modalW && instanceOf(modalW,raModal)){
		return modalW.close();
	}
}