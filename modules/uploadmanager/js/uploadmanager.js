var mup;
// var up_options = {};
window.addEvent('domready', function() {
	mup = new raModal({
		divBlockID: 'yoba',
		divModalID: 'yobaForm',
		onClose: function(){
			
		}
	});
	// up_options = {
		// filetype: 'jpg,jpeg,gif,png',
		// limit: 0,
		// size_limit: 0,
		// crop_text: 'Выберите область фотографии. Данная область будет отображаться на уменьшенных копиях фотографии.',
		// comment: ''
	// };
});



function toggleUploadButton_(uploader){
	if(!uploader._options.autoUpload && $('upload-manager-submit')){
		if(uploader._storedFileIds.length){
			$('upload-manager-submit').removeProperty('style');
		}
		else{
			$('upload-manager-submit').setStyle('display','none');
		}
	}
}
function upload_crop(res,section,_options){
	if(res.files[0].width.toInt() != _options.crop_options.width.toInt() || res.files[0].height.toInt() != _options.crop_options.height.toInt()){
		var mdv = getModalWUM().empty();
		showLoaderUM();
		unShowLoaderUM();
		var ann = new Element('div',{
			styles:{
				'float':'right',
				'width': 230,
				'margin':'0 0 10px 10px'
			},
			html: _options.crop_text ? '<p style="padding-left:10px;">'+_options.crop_text+'</p>' : ''
		}).inject(mdv);
		
		var dvi = new Element('div',{
			styles:{
				display: 'block',
				position: 'relative',
				marginBottom: 20
			}
		});
		cropH = _options.crop_options.height;
		cropW = _options.crop_options.width;
		dvi.inject(mdv);
		var r = new Element('div',{
			styles: {
				height: cropH.toInt()-4,
				width: cropW.toInt()-4,
				left: 0,
				top: 0,
				border: '2px solid #04ff20',
				position: 'absolute',
				cursor: 'move',
				overflow: 'hidden'
			}
		});
		var fade = new Element('div',{
			styles: {
				bottom: 0,
				right: 0,
				left: 0,
				top: 0,
				position: 'absolute',
				background: '#000000',
				opacity: 0.5
			}
		});
		var fn = res.files[0][_options.data.file_field];
		// var u = _options.crop_options.dir ? _options.crop_options.dir+fn : _options.data.dir+fn;
		var u = _options.data.dir+fn;
		var im = new Element('img',{
			src: gbu(u),
			styles:{
				display: 'block'
			}
		});
		var cim = im.clone().setStyle('position','absolute');
		var set_subimg = function(){
			var s = r.getStyles('top','left');
			cim.setStyles(Object.map(s,function(v){
				return -1*v.toInt()-2;
			}));
		};
		
		var s = {x: res.files[0].width,y: res.files[0].height};
		var w = _options.crop_options.width;
		var h = _options.crop_options.height;
		var r1 = w/s.x;
		var r2 = h/s.y;
		var r_ = r1 > r2 ? r1 : r2;
		
		s.x = r_ * s.x;
		s.y = r_ * s.y;
		im.setStyles({
			width: s.x,
			height: s.y
		});
		dvi.setStyles({
			width: s.x,
			height: s.y,
			overflow: 'hidden',
			background: '#cccccc url('+gbu('/modules/uploadmanager/images/loading.gif')+') no-repeat 50% 50%'
		});
		cim.setStyles({
			width: s.x,
			height: s.y,
			maxWidth: 'none',
			maxHeight: 'none',
		});
		r.setStyles({
			left: res.files[0].x.toInt()/res.files[0].width.toInt()*s.x,
			top: res.files[0].y.toInt()/res.files[0].height.toInt()*s.y,
		});
		set_subimg();
			
		// im.addEvent('load',function(){
			
		// });
		im.inject(dvi);
		fade.inject(dvi);
		
		cim.inject(r);
		r.inject(dvi);
		
		r.makeDraggable({
			container: dvi,
			onDrag: set_subimg
		});
		var bn = new Element('input',{
			'type': 'button',
			'class': 'button2',
			value: 'Сохранить',
			events:{
				click: function(){
					var s = r.getStyles('top','left');
					var s2 = im.getSize();
					
					res.files[0].x = s.left.toInt()/s2.x;
					res.files[0].y = s.top.toInt()/s2.y;
					
					upload_send_crop(res,section,_options);	
				}
			},
			styles:{
				'float':'right'
			}
		});
		bn.inject(mdv);
	}
	else{
		upload_send_crop(res,section,_options);
	}
}
function upload_send_crop(res,section,_options){
	var obj = res;
		obj.section = section;
		obj.action = 'crop';
	var myRequest = new Request.JSON({
		url: '/uploadmanager/upload',
		method: 'post',
		evalScripts: true,
		onSuccess: function(r,rt){
			if(_options.autorefresh){
				document.location.reload();
			}
			if(_options.autoclose){
				closeModalWUM();
			}
			if(_options.oncomplete){
				eval(_options.oncomplete).attempt([r,section,_options]);
			}
		}
	}).send(Object.toQueryString(obj));
}
function upload_complete(res,section,_options){
	var obj = res;
		obj.section = section;
		obj.action = 'complete';
		obj.template = _options.template;
	var myRequest = new Request.JSON({
		url: '/uploadmanager/upload',
		method: 'post',
		update: 'uploadFiles_'+section+'_'+obj.files[0][_options.data.obj_field],
		onSuccess: function(r,rt){
			extractSections(r);
		}
	}).send(Object.toQueryString(obj));

}
function upload_delete(res,section,_options){
	var obj = res;
		obj.section = section;
		obj.action = 'delete';
	var myRequest = new Request.JSON({
		url: '/uploadmanager/upload',
		method: 'post',
		onSuccess: function(r,rt){
			if(_options.autorefresh){
				document.location.reload();
			}
			if(_options.oncomplete){
				eval(_options.oncomplete).attempt([r,section,_options]);
			}
		}
	}).send(Object.toQueryString(obj));

}
function unShowLoaderUM(){
	if(mup && instanceOf(mup,raModal))
		mup.unShowLoader();
}
function showLoaderUM(){
	if(mup && instanceOf(mup,raModal))
		mup.ShowLoader();
}
function getModalWUM(){
	if(mup && instanceOf(mup,raModal)){
		return mup.get();
	}
}
function closeModalWUM(){
	if(mup && instanceOf(mup,raModal)){
		return mup.close();
	}
}
function upload_form_new(elem,section,opts){
	showLoaderUM();
	unShowLoaderUM();
	
	opts.section = section;
	// opts = Object.merge(up_options,opts);
	_options = opts;
	
	var upload_info = '';
		upload_info += _options.filetype ? '<div class="item filetypes">Разрешенные для загрузки типы файлов: ' + _options.filetype.split(',').join(', ')+'</div>' : '';
		upload_info += _options.filesize && _options.filesize.toInt() ? '<div class="item filesize">Максимальный размер файла: ' + _options.filesize+'</div>' : '';
		upload_info += _options.maxsize && _options.maxsize.toInt() ? '<div class="item maxsize">Максимальный размер загружаемых файлов: ' + _options.maxsize+'</div>' : '';
		upload_info += _options.limit && _options.limit.toInt() ? '<div class="item limit">Максимальное количество файлов: ' + _options.limit+'</div>' : '';
		upload_info += _options.comment ? '<div class="item comment">' + _options.comment+'</div>' : '';
		upload_info = upload_info ? "<div class='upload-info'>" + upload_info + "</div>" : "";
		
	getModalWUM().set('html','<form action="" method="get" id="upload-manager-form">'
		+'<span class="message"></span><span id="yoba"></span><div class="upload-link">'
		+'<span id="uploadmanager-upload-link" class="upload-button">Добавить файл</span> '
		+'</div><div id="uploadmanager-container"></div><div id="uploadmanager-drop"></div>'
		+ upload_info
		+'<div style="text-align:right;margin-top:10px;"><input type="button" class="upload-submit" id="upload-manager-submit" value="Сохранить" '
		+'style="display: none;"></div></form>'
	);
	
	var uploaderOptions = upload_options(_options);
		uploaderOptions.element = $('uploadmanager-upload-link');
		uploaderOptions.listElement = $('uploadmanager-container');
		
	var uploader = new qq.FineUploader(
		uploaderOptions
	);
	uploader.uploadedFiles = [];
	uploader.filesSelected = 0;
	
	$('upload-manager-submit').addEvent('click', function(e) {
		uploader.uploadStoredFiles();
	});
	mup.addEvent('close',function(){
		delete uploader;
	});
}
document.addEvent('mouseover:relay([data-upload=not_ready])',function(e){
	this.set('data-upload','ready');
	
	var section = this.get('data-section');
	var opts = JSON.decode(this.get('data-options'));

	opts.section = section;
	// opts = Object.merge(up_options,opts);
	var _options = opts;

	var uploaderOptions = upload_options(_options);
		uploaderOptions.button = this;
		uploaderOptions.autoUpload = true;
	var uploader = new qq.FineUploaderBasic(
		uploaderOptions
	);
	uploader.uploadedFiles = [];
	uploader.filesSelected = 0;
});

function upload_options(_options){
	return {
		request:{
			endpoint: '/uploadmanager/upload',
			params:Object.merge({
				section: _options.section,
				action: 'uploadfiles',
				fields: _options.fields || {},
				params: _options.params || {}
			},_options.pars)
		},
		autoUpload: _options.autoUpload,
		multiple: !(_options.limit==1),
		text:{
			uploadButton: 'Добавить файл',
			cancelButton: 'Отменить'
		},
		validation:{
			allowedExtensions: _options.filetype ? _options.filetype.split(',') : [],
			sizeLimit: _options.size_limit ? _options.size_limit.toInt() : 0
		},
		fileTemplate: '<div class="upload-item">' +
            '<div class="qq-progress-bar"></div>' +
            '<span class="file"></span>' +
			'<span class="upload-loading"></span>' +
            '<span class="size"></span>' +
            '<span class="status"></span>' +
            '<a class="cancel">{cancelButtonText}</a>' +
            '</div>',
        classes: {
            file: 'file',
            spinner: 'upload-loading',
            size: 'size',
            cancel: 'cancel',
			statusText: 'status',

            success: null,
            fail: null

        },
		callbacks: {
			onError: function(id,filename,error){
				
			},

			onSubmit: function(id, fileName){
				if(_options.limit.toInt()){
					if(this.filesSelected+1 > _options.limit)
						return false;
					else
						this.filesSelected++;
				}
			},
			onAfterSubmit: function(id, fileName){
				toggleUploadButton_(this);
			},
			onCancel:function(fileData){
				this.filesSelected--;
				toggleUploadButton_(this);
			},
			onProgress: function(id, fileName, loaded, total){
				if(_options.onprogress){
					eval(_options.onprogress).attempt([{id:id, filename:fileName, loaded:loaded, total:total},_options.section,_options]);
				}
			},
			onComplete:function(id,filename,res){
				
				if(res.success){
					var file = res.files[0];
					this.uploadedFiles.push(file);
				}
				if(!this._filesInProgress){
					if(_options.crop){
						upload_crop({files:this.uploadedFiles,success:1},_options.section,_options);
					}
					else{
						if(_options.oncomplete){
							eval(_options.oncomplete).attempt([{files:this.uploadedFiles,success:1},_options.section,_options]);
						}
						if(_options.autoclose){
							closeModalWUM();
						}
						if(_options.autorefresh){
							document.location.reload();
						}
					}
					this.uploadedFiles = [];
					this.filesSelected = 0;
				}
			}
		},
		showMessage: function(message){
			
		},
		debug: false
	};
}