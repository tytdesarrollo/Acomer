(function() {

	var viewEl = document.querySelector('.cat__content-main'),
		gridOrderEl = viewEl.querySelector('.cat__grid'),
		items = [].slice.call(gridOrderEl.querySelectorAll('.product')),
		basket;

	// the compare basket
	function CompareBasket() {
		this.el = document.querySelector('.compare-basket');
		this.compareCtrl = this.el.querySelector('.action--compare');
		this.compareWrapper = document.querySelector('.compare'),
		this.closeCompareCtrl = this.compareWrapper.querySelector('.action--close-compare')
		
		this.itemsAllowed = 10;
		this.totalItems = 0;
		this.items = [];
	}

	CompareBasket.prototype.add = function(item) {
		// check limit
		if( this.isFull() ) {
			return false;
		}

		classie.add(item, 'product--selected');

		// create item preview element
		var preview = this._createItemPreview(item);
		// prepend it to the basket
		this.el.insertBefore(preview, this.el.childNodes[0]);
		// insert item
		this.items.push(preview);

		this.totalItems++;
		if( this.isFull() ) {
			classie.add(this.el, 'compare-basket--full');
		}

		classie.add(this.el, 'compare-basket--active');
	};

	CompareBasket.prototype._createItemPreview = function(item) {
		var self = this;

		var preview = document.createElement('div');
		preview.className = 'product-icon';		
		preview.setAttribute('data-idx', items.indexOf(item));
		
	
		var x = item.querySelector('.content-count');	
		var num = x.getAttribute("id");

		var contador = document.getElementsByClassName('input-number')[num].value;
		// var porClassName=document.getElementsByClassName("formulario")[0].value;
		
		preview.setAttribute('id', items.indexOf(item)+':'+contador);
		
		var removeCtrl = document.createElement('button');
		removeCtrl.className = 'actions action--remove';
		removeCtrl.innerHTML = '<i class="material-icons">&#xE14C;</i><span class="action__text action__text--invisible">Eliminar<span>';
		removeCtrl.addEventListener('click', function() {
			self.remove(item);			
		});
	
		var productImageEl = item.querySelector('img.product__image').cloneNode(true);
		
		var mostrarconta = document.createElement('p');
		mostrarconta.className = 'unit';
		mostrarconta.innerHTML = 'x'+contador;
	

		preview.appendChild(productImageEl).addEventListener('click', function() {
			verNotaPlato(this.parentElement.getAttribute("data-info"));
		});		
		preview.appendChild(removeCtrl);
		preview.appendChild(mostrarconta);

		var productInfo = item.querySelector('.product__info').innerHTML;
		preview.setAttribute('data-info', productInfo);

		return preview;
	};

	CompareBasket.prototype.remove = function(item) {
		removeNote(item);
		classie.remove(this.el, 'compare-basket--full');
		classie.remove(item, 'product--selected');
		var preview = this.el.querySelector('[data-idx = "' + items.indexOf(item) + '"]');
		this.el.removeChild(preview);
		this.totalItems--;

		var indexRemove = this.items.indexOf(preview);
		this.items.splice(indexRemove, 1);

		if( this.totalItems === 0 ) {
			classie.remove(this.el, 'compare-basket--active');
		}

		// checkbox
		var checkbox = item.querySelector('.action--compare-add > input[type = "checkbox"]');
		if( checkbox.checked ) {
			checkbox.checked = false;
		}
	};

	CompareBasket.prototype.isFull = function() {
		return this.totalItems === this.itemsAllowed;
	};

	function init() {
		// initialize an empty basket
		basket = new CompareBasket();
		initEvents();
	}

	function initEvents() {
		items.forEach(function(item) {
			var checkbox = item.querySelector('.action--compare-add > input[type = "checkbox"]');
			checkbox.checked = false;

			// ctrl to add to the "compare basket"
			checkbox.addEventListener('click', function(ev) {
				if( ev.target.checked ) {
					if( basket.isFull() ) {
						ev.preventDefault();
						return false;
					}
					basket.add(item);
				}
				else {
					basket.remove(item);
				}
			});
		});
	}

	init();

})();