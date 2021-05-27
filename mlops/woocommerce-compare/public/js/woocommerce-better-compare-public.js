(function( $ ) {
	'use strict';

	// Create the defaults once
	var pluginName = "compareProducts",
		defaults = {

			// Add to Compare
			addToCompareLink : '.add-to-compare-button',
			removeFromCompareLink : '.remove-from-compare-button',

			// Compare Bar
			openCloseBarLink : $('#woocommerce-compare-bar-open-close'),
			openCloseBarIcon : $('#woocommerce-compare-bar-open-close i'),
			openCloseBarContainer : $('#woocommerce-compare-bar-open-close-container'),
			compareBar : $('#woocommerce-compare-bar'),
			compareBarItems : $('#woocommerce-compare-bar-items'),
			compareBarClear : $('#woocommerce-compare-bar-action-clear'),
			compareBarRemoveLink : '.woocommerce-compare-bar-item-remove',

			compareItemRemoveLink : '.woocommerce-compare-single-item-remove',

			// Compare Sidebar
			compareSidebar : $('#woocommerce-compare-sidebar'),
			compareSidebarItems : $('#woocommerce-compare-sidebar-items'),
			compareSidebarClear : $('#woocommerce-compare-sidebar-action-clear'),
			compareSidebarRemoveLink : '.woocommerce-compare-sidebar-item-remove',	

			// Actions
			clearAllLink : $('.clear-all-compared-products'),

			// Compare Table
			compareTable : $('#woocommerce-compare-table'),
			compareTableOpenLink : $('.woocommerce-compare-table-action-compare'),
			compareTableContainer : $('#woocommerce-compare-table-container'),
			compareTableCloseLink : $('#woocommerce-compare-table-close'),

			compareTableHideSimilaritiesCheckbox : $('.woocommerce-compare-table-hide-similarities'),
			compareTableHighlightDifferencesCheckbox : $('.woocommerce-compare-table-highlight-differences'),

			compareAutocompleteInput : '.woocommerce-compare-autocomplete-field',
			compareAutocompleteMessage : '.woocommerce-compare-autocomplete-message',
			
		};

	// The actual plugin constructor
	function Plugin ( element, options ) {
		this.element = element;
		this.settings = $.extend( {}, defaults, options );
		this._defaults = defaults;
		this.trans = this.settings.trans;
		this._name = pluginName;
		this.init();
	}

	// Avoid Plugin.prototype conflicts
	$.extend( Plugin.prototype, {
		init: function() {
			this.window = $(window);
			this.currentURL = window.location.href;
			this.documentHeight = $( document ).height();
			this.windowHeight = this.window.height();
			this.products = {};

			var singleCompareValues = {};
			$('.single-product-compare-value').each(function() {
				var compareValue = '.' + ($(this).attr('class').slice(34));
				singleCompareValues[compareValue] = compareValue;
			});

			this.isMobile = window.matchMedia("only screen and (max-width: 760px)").matches;
			if(this.isMobile) {
				var toRemove = this.settings.maxProducts - this.settings.maxProductsMobile;
				for (var i = 0; i < toRemove; i++) {
					$('.woocommerce-compare-bar-item-placeholder').first().remove();
					$('.woocommerce-compare-sidebar-item-placeholder').first().remove();
				}
				
			}

			this.singleCompareValues = singleCompareValues;
			this.compareBarOpenClose();
			this.compareBarAdd();
			this.compareBarRemove();

			this.compareAccordion();

			this.compareTableOpen();
			this.compareTableClose();
			this.compareTableHighlightDifferences();
			this.compareTableHideSimilarities();

			this.loadSaved();
			this.clearAll();

			this.singleProductSlider();
			this.singleCompareTableSlider();
			this.singleCompareTableHighlightDifferences();
			this.singleCompareTableHideSimilarities();

			this.compareBarAutocomplete();

			this.alignCompareTableRowHeight();
		},
		loadSaved: function() {

			var that = this;

			var savedProducts = that.readCookie('compare_products_products');
			var urlProducts = that.getParameterByName('compare');

			if(!that.isEmpty(savedProducts)) {
				that.products = savedProducts;
				$.each(savedProducts, function(i, index) {
					that.getSingleProduct(i, true);
				});

				$.each($(that.settings.addToCompareLink), function(i, index) {
					var $this = $(this);
					var product_id = $(index).data('product-id');
					if(typeof(that.products[product_id]) != "undefined") {
						$this.removeClass('add-to-compare-button').addClass('remove-from-compare-button').html(that.trans.remove);
					}
				});
			} 
			else if(!that.isEmpty(urlProducts)) {

				var jsonStrig = '{';
				var items = urlProducts.split(',');
				for (var i = 0; i < items.length; i++) {
				  jsonStrig += '"' + items[i] + '":"' + items[i] + '",';
				}
				jsonStrig = jsonStrig.substr(0, jsonStrig.length - 1);
				jsonStrig += '}';
				that.products = JSON.parse(jsonStrig);
				$.each(that.products, function(i, index) {
					that.getSingleProduct(i);
				});

				$.each($(that.settings.addToCompareLink), function(i, index) {
					var $this = $(this);
					var product_id = $(index).data('product-id');
					if(typeof(that.products[product_id]) != "undefined") {
						$this.removeClass('add-to-compare-button').addClass('remove-from-compare-button').html(that.trans.remove);
					}
				});
			}
		},
		compareBarAdd : function() {

			var that = this;
			var product_id;

			$(document).on('click', that.settings.addToCompareLink, function(e) {
				e.preventDefault();

				var $this = $(this);

				$this.html('<i class="fa fa-refresh fa-spin"></i>')

				product_id = $this.data('product-id');

				if($this.attr('href') != "#") {

					that.products = {};
					that.deleteCookie('compare_products_products')	
					var savedProducts = that.readCookie('compare_products_products');

					that.buildReplaceState();

					window.location = $this.attr('href');
					return;
				}

				if(product_id == "") {
					$this.html(that.trans.add);
					return;
				}

				if(typeof(that.products[product_id]) != 'undefined') {
					$this.html(that.trans.add);
					return;
				}

				// if(that.isEmpty(that.products)) {
				// 	that.compareBarClose();
				// }

				that.getSingleProduct(product_id);
			});
		},
		compareBarRemove : function() {

			var that = this;

			$('.woocommerce-single-compare-table').on('click', that.settings.compareItemRemoveLink, function(e) {
				e.preventDefault();

				var $this = $(this);
				var product_id = $this.data('product-id');
				
				$(document).find('.remove-from-compare-button[data-product-id="' + product_id + '"]').removeClass('remove-from-compare-button').addClass('add-to-compare-button').html(that.trans.add);
				$(document).find('.single-product-compare-column-' + product_id).remove();
				
				that.removeProduct(product_id);
			});

			$('.woocommerce-compare-bar-items').on('click', that.settings.compareBarRemoveLink, function(e) {
				e.preventDefault();

				var $this = $(this);
				var product_id = $this.data('product-id');
				
				$(document).find('.remove-from-compare-button[data-product-id="' + product_id + '"]').removeClass('remove-from-compare-button').addClass('add-to-compare-button').html(that.trans.add);
				
				that.removeProduct(product_id);
			});

			$('.woocommerce-compare-sidebar-items').on('click', that.settings.compareSidebarRemoveLink, function(e) {
				e.preventDefault();

				var $this = $(this);
				var product_id = $this.data('product-id');
				
				$(document).find('.remove-from-compare-button[data-product-id="' + product_id + '"]').removeClass('remove-from-compare-button').addClass('add-to-compare-button').html(that.trans.add);
				
				that.removeProduct(product_id);
			});

			$(document).on('click', that.settings.removeFromCompareLink, function(e) {
				e.preventDefault();

				var $this = $(this);
				var product_id = $this.data('product-id');
				
				$(document).find('.remove-from-compare-button[data-product-id="' + product_id + '"]').removeClass('remove-from-compare-button').addClass('add-to-compare-button').html(that.trans.add);
				

				that.removeProduct(product_id);
			});
		},
		compareAccordion : function() {

			var that = this;
			var accordionTitles = $('.woocommerce-better-compare-accordion-title');
			if(accordionTitles.length < 1) {
				return;
			}

			// inital 
			accordionTitles.each(function(i, index) {
				
				var $this = $(this);
				if($this.hasClass('woocommerce-better-compare-accordion-title-open')) {
					return;
				}

				var attributesToHide = $this.data('hide-attributes');
				$(attributesToHide).each(function(i, index) {
					$('.single-product-compare-value-attr-' + index).hide();
				});
			});


			$('.woocommerce-better-compare-accordion-title').on('click', function(e) {
				var $this = $(this);
				var attributesToHide = $this.data('hide-attributes');
				if(attributesToHide.length < 0) {
					return;
				}

				var groupId = $this.data('group-id');
				var allGroupTitles = $('.woocommerce-better-compare-accordion-title.single-product-compare-value-group-' + groupId);

				if($this.hasClass('woocommerce-better-compare-accordion-title-open')) {

					allGroupTitles.removeClass('woocommerce-better-compare-accordion-title-open');
					allGroupTitles.find('.woocommerce-group-attributes-icon').removeClass('fa-minus').addClass('fa-plus');
					$(attributesToHide).each(function(i, index) {
						$('.single-product-compare-value-attr-' + index).hide();
					});

				} else {

					allGroupTitles.addClass('woocommerce-better-compare-accordion-title-open');
					allGroupTitles.find('.woocommerce-group-attributes-icon').addClass('fa-minus').removeClass('fa-plus');
					$(attributesToHide).each(function(i, index) {
						$('.single-product-compare-value-attr-' + index).show();
					});
				}
			});

		},
		removeProduct : function(product_id) {
			var that = this;

			var barContainer = $('.woocommerce-compare-bar-items').find('.woocommerce-compare-bar-item-container[data-product-id="' + product_id + '"]');
			barContainer.addClass('woocommerce-compare-bar-item-placeholder').removeData('data-product-id');
			barContainer.find('.woocommerce-compare-bar-item').html('');

			var sidebarContainer = $('.woocommerce-compare-sidebar-items').find('.woocommerce-compare-sidebar-item-container[data-product-id="' + product_id + '"]');
			sidebarContainer.addClass('woocommerce-compare-sidebar-item-placeholder').removeData('data-product-id');
			sidebarContainer.find('.woocommerce-compare-sidebar-item').html('');
			delete that.products[product_id];

			if (window.history.replaceState) {
				that.buildReplaceState();
			}

			that.saveCookie('compare_products_products', that.products, 30);
		},
		getSingleProduct: function(product_id, isSaved) {

			var that = this;
			if(isSaved === undefined) {
			  isSaved = false;
			}

			jQuery.ajax({
				url: that.settings.ajax_url,
				type: 'post',
				dataType: 'JSON',
				data: {
					action: 'compare_products_get_single',
					product: product_id
				},
				success : function( response ) {

					if(response.status == "error") {
						var remove = confirm(response.message);
						if(remove == true) {
							that.settings.clearAllLink.trigger('click');
							that.getSingleProduct(product_id);
							return;
						} else {
							$('.add-to-compare-button[data-product-id="' + product_id + '"]').html(that.trans.add)
							return;
						}
					}

					that.products[product_id] = product_id;

					if(that.isMobile) {
						that.settings.maxProducts = that.settings.maxProductsMobile;
					}

					if(that.getObjectSize(that.products) > that.settings.maxProducts) {

						delete that.products[product_id];
						$('.add-to-compare-button[data-product-id="' + product_id + '"]').html(that.trans.add)
						alert(that.trans.max);
						return;
					}
					
					that.saveCookie('compare_products_products', that.products, 30);

					if (window.history.replaceState) {
						that.buildReplaceState();
					}

					if(that.settings.compareBar.length > 0) {
						that.addProductToBar(response, isSaved);
					}
					if(that.settings.compareSidebar.length > 0) {
						that.addProductToSidebar(response);
					}
					$('.add-to-compare-button[data-product-id="' + product_id + '"]').removeClass('add-to-compare-button').addClass('remove-from-compare-button').html(that.trans.remove);
				},
				error: function(jqXHR, textStatus, errorThrown) {

					that.removeProduct(product_id);
				    console.log('An Error Occured: ' + jqXHR.status + ' ' + errorThrown + '! Please contact System Administrator!');
				}
			});
		},
		addProductToBar : function(product, isSaved) {

			var that = this;
			var emptyBarItemContainers = $('.woocommerce-compare-bar-item-placeholder')
			var product_id = product['ID'];

			if(isSaved === undefined) {
			  isSaved = false;
			}

			if(emptyBarItemContainers.length > 0) {

				var emptyBarItemContainer = $(emptyBarItemContainers[0]);
				emptyBarItemContainer.attr('data-product-id', product_id);
				emptyBarItemContainer.removeClass('woocommerce-compare-bar-item-placeholder');

				var html = '<a href="' + product.url + '"><img src="' + product['img'] + '"></a><a href="#" data-product-id="' + product_id + '" class="woocommerce-compare-bar-item-remove"><i class="fa fa-times"></i></a>';
				html += '<a href="' + product.url + '"><div class="woocommerce-compare-bar-title">' + product.title + '</div></a>';
				emptyBarItemContainer.find('.woocommerce-compare-bar-item').html(html);
				
				if(that.getObjectSize(that.products) >= 2 && !isSaved) {
					that.compareBarOpen();
				}
			}
		},
		addProductToSidebar : function(product) {

			var that = this;
			var emptySidebarItemContainers = $('.woocommerce-compare-sidebar-item-placeholder')
			var compareBarExists = that.settings.compareBar;

			var product_id = product['ID'];

			if(emptySidebarItemContainers.length > 0) {

				var emptySidebarItemContainer = $(emptySidebarItemContainers[0]);
				emptySidebarItemContainer.attr('data-product-id', product_id);
				emptySidebarItemContainer.removeClass('woocommerce-compare-sidebar-item-placeholder');

				var html = '<div class="woocommerce-compare-sidebar-img">';
					html += '<a href="' + product.url + '"><img src="' + product['img'] + '"></a><a href="#" data-product-id="' + product_id + '" class="woocommerce-compare-sidebar-item-remove"><i class="fa fa-times"></i></a>';
				html += '</div>';
				html += '<a href="' + product.url + '"><div class="woocommerce-compare-sidebar-title">' + product.title + '</div></a>';
				html += '<div class="woocommerce-compare-sidebar-clearfix"></div>';
				emptySidebarItemContainer.find('.woocommerce-compare-sidebar-item').html(html);
			}
		},
		compareBarOpenClose: function() {
			
			var that = this;

			that.settings.openCloseBarLink.on('click', function(e) {
				e.preventDefault();

				if(that.settings.compareBarItems.is(':visible')) {
					that.compareBarClose();
				} else {
					that.compareBarOpen();
				}
			});
		},
		compareBarOpen: function() {
			this.settings.compareBarItems.slideDown(1000);
			this.settings.openCloseBarIcon.removeClass('fa-angle-double-up').addClass('fa-angle-double-down');
		},
		compareBarClose: function() {
			this.settings.compareBarItems.slideUp(1000);
			this.settings.openCloseBarIcon.removeClass('fa-angle-double-down').addClass('fa-angle-double-up');
		},
		compareTableOpen : function() {
			
			var that = this;

			that.settings.compareTableOpenLink.on('click', function(e) {
				
				if (!(/#/.test(this.href))) {
					return;
				}

				e.preventDefault();

				if(that.isEmpty(that.products)) {
					return;
				}

				that.compareBarClose();

				jQuery.ajax({
					url: that.settings.ajax_url,
					type: 'post',
					dataType: 'JSON',
					data: {
						action: 'compare_products_get_all',
						products: that.products
					},
					success : function( response ) {
						that.settings.compareTableContainer.slideDown(1000);
						if(that.isEmpty(response)) {
							return;
						}
						that.renderCompareTable(response);
					},
					error: function(jqXHR, textStatus, errorThrown) {
					    console.log('An Error Occured: ' + jqXHR.status + ' ' + errorThrown + '! Please contact System Administrator!');
					}
				});
			});
		},
		renderCompareTable : function (data) {
			
			var that = this;
			var html = "";
			var compareTable = that.settings.compareTable;
			
			var maxCols = 12;
			var attributeNameCols = 2;
			var productsCount = that.getObjectSize(that.products);

			maxCols = maxCols - attributeNameCols;

			var singleColXS = Math.floor(12 / productsCount);
			var singleCol = Math.floor(maxCols / productsCount);
			var tableCompareValues = {};

			compareTable.html();
			
			$.each(data, function(i, products) {

				var compareValue = '.compare-table-row-attribute-value-' + i;
				tableCompareValues[compareValue] = compareValue;

				html += '<div class="row compare-table-row compare-table-row-' + i + '">';
					html += '<div class="col-xs-12 col-sm-2 compare-table-row-attribute-name compare-table-row-attribute-name-' + i + '">' + that.trans[i] + '</div>';

					$.each(products, function(product_id, product_data) {
						// if(i == "im") {
						// 	product_data = '<img class="compare-table-responsive-image" src="' + product_data + '" />';
						// }
						html += '<div class="col-xs-' + singleColXS + ' col-sm-' + singleCol + ' compare-table-row-attribute-value compare-table-row-attribute-value-' + i + '">' + product_data + '</div>';
						
					});
					html += '<div class="compare-table-row-clear"></div>';
				html += '</div>';
			});
			that.tableCompareValues = tableCompareValues;

			compareTable.html(html);

			
			$('.compare-table-row-attribute-value').each(function() {
				var compareValue = '.' + ($(this).attr('class').slice(43));
				
			});

		},
		compareTableClose : function () {
			
			var that = this;

			that.settings.compareTableCloseLink.on('click', function(e) {
				e.preventDefault();
				that.settings.compareTableContainer.slideUp(1000);

				// that.compareBarOpen();
			});
		},
		clearAll : function () {

			var that = this;

			that.settings.clearAllLink.on('click', function(e) {
				e.preventDefault();

				$.each(that.products, function(i, product_id) {
					
					$('.remove-from-compare-button[data-product-id="' + product_id + '"]').removeClass('remove-from-compare-button').addClass('add-to-compare-button').html(that.trans.add);
					var barContainer = $('.woocommerce-compare-bar-items').find('.woocommerce-compare-bar-item-container[data-product-id="' + product_id + '"]');
					barContainer.addClass('woocommerce-compare-bar-item-placeholder').removeData('data-product-id');
					barContainer.find('.woocommerce-compare-bar-item').html('');

					var sidebarContainer = $('.woocommerce-compare-sidebar-items').find('.woocommerce-compare-sidebar-item-container[data-product-id="' + product_id + '"]');
					sidebarContainer.addClass('woocommerce-compare-sidebar-item-placeholder').removeData('data-product-id');
					sidebarContainer.find('.woocommerce-compare-sidebar-item').html('');
					
				});	
				that.compareBarClose();
				that.products = {};
				that.deleteCookie('compare_products_products')	
				var savedProducts = that.readCookie('compare_products_products');

				that.buildReplaceState();
			});
		},
		compareBarAutocomplete : function() {

			var that = this;

			if(that.settings.compareAutocompleteInput.length < 1) {
				return false;
			}

			var autoCompleteTimer = null;

			$(document).on('keyup', '.woocommerce-compare-autocomplete-field', function (e) {

			    if (autoCompleteTimer) {
			        clearTimeout(autoCompleteTimer);
			    }

			    var $this = $(this);

			    autoCompleteTimer = setTimeout(function() {

				  	
				  	var skuOrProduct = $this.val();
				  	var autoCompleteContainer = $this.parents('.woocommerce-compare-autocomplete');
				  	var autoCompleteIcon = autoCompleteContainer.find('.fa');
				  	var autoCompleteMessage = autoCompleteContainer.find('.woocommerce-compare-autocomplete-message');

				  	if(skuOrProduct == "") {
				  		return true;
				  	}

				  	autoCompleteIcon.removeClass('fa-eye').addClass('fa-spin fa-circle-o-notch');

	  				jQuery.ajax({
						url: that.settings.ajax_url,
						type: 'post',
						dataType: 'json',
						data: {
							action: 'compare_check_product',
							skuOrProduct: skuOrProduct
						},
						success : function( response ) {
							
							autoCompleteMessage.text(response.message);
							autoCompleteIcon.removeClass('fa-spin fa-circle-o-notch').addClass('fa-eye');

							if(response.products) {

								var autocompleteResultHTML = "";
								$(response.products).each(function(i, index) {
									autocompleteResultHTML += '<a href="#" data-product-id="' + index.id + '" class="woocommerce-compare-autocomplete-result-item">';

										autocompleteResultHTML += '<div class="woocommerce-compare-autocomplete-result-item-image">';
											autocompleteResultHTML += '<img src="' + index.img + '">';
										autocompleteResultHTML += '</div>';

										autocompleteResultHTML += '<div class="woocommerce-compare-autocomplete-result-item-name">';
											autocompleteResultHTML += '<b>' + index.name + '</b>';
										autocompleteResultHTML += '</div>';
										autocompleteResultHTML += '<div class="compare-table-row-clear"></div>';

									autocompleteResultHTML += '</a>';
								});
								autoCompleteContainer.find('.woocommerce-compare-autocomplete-results').html(autocompleteResultHTML);
							}
						},
						error: function(jqXHR, textStatus, errorThrown) {
						    console.log('An Error Occured: ' + jqXHR.status + ' ' + errorThrown + '! Please contact System Administrator!');
						}
					});

				  	return false;
			  	}, 400); 
			});

			$(document).on('click', '.woocommerce-compare-autocomplete-result-item', function(e) {
				e.preventDefault();

				var $this = $(this);
				var productId = $this.data('product-id');

				var resultListContainer = $this.parent();
				
				if(resultListContainer.hasClass('woocommerce-compare-autocomplete-results-is-column')) {
					jQuery.ajax({
						url: that.settings.ajax_url,
						type: 'post',
						dataType: 'JSON',
						data: {
							action: 'compare_products_get_single_column',
							product: productId
						},
						success : function( response ) {

							resultListContainer.parents('.slick-slider').slick('unslick');
							resultListContainer.parents('.single-product-compare-products-slick').slick('unslick');

							resultListContainer.parents('.single-product-compare-column').replaceWith(response.html);
							$('.woocommerce-single-compare-table-slick').slick();
							$('.single-product-compare-products-slick').slick();
						},
						error: function(jqXHR, textStatus, errorThrown) {
							that.removeProduct(productId);
						    console.log('An Error Occured: ' + jqXHR.status + ' ' + errorThrown + '! Please contact System Administrator!');
						}
					});
				}
				
				that.getSingleProduct(productId);

				$('.woocommerce-compare-autocomplete-results').html('');
				$('.woocommerce-compare-autocomplete-field').val('');
			});
		},
		compareTableHighlightDifferences : function() {

			var that = this;
			that.settings.compareTableHighlightDifferencesCheckbox.on('change', function(e) {

				var $this = $(this);

				if($this.is(':not(:checked)')) {
					$.each(that.tableCompareValues, function(i, index) {
						$(index).removeClass('compare-table-highlight');
					});
				  	return;
				}
					
	            $.each(that.tableCompareValues, function(i, index){

	            	var values = [];
	            	var columns = $(index);
	            	$.each(columns, function(){
	            		values.push($(this).text());
	        		});
	        		if(values.length > 0) {
			            var allSame = !!values.reduce(function(a, b){ return (a === b) ? a : NaN; });
			            if(allSame == false){
			            	columns.addClass('compare-table-highlight');
			            }
		            }
			    });
			});

		},
		compareTableHideSimilarities : function() {

			var that = this;
			
			that.settings.compareTableHideSimilaritiesCheckbox.on('change', function(e) {

				var $this = $(this);

				if($this.is(':not(:checked)')) {
					$.each(that.tableCompareValues, function(i, index) {
						var row = index.replace('value', 'name');
						$(row).removeClass('compare-table-hidden');
						$(index).removeClass('compare-table-hidden');
					});
				  	return;
				}

	            $.each(that.tableCompareValues, function(i, index){
	            	var values = [];
	            	var columns = $this.parent().parent().find(index);

	            	if(i == ".compare-table-row-attribute-value-rm" || i.substr(0, 40) == ".compare-table-row-attribute-value-group") {
	            		return;
	            	}

	            	$.each(columns, function(){
	            		values.push($(this).text());
	        		});
	        		if(values.length > 0) {
			            var allSame = !!values.reduce(function(a, b){ return (a === b) ? a : NaN; });
			            if(allSame == true){
			            	var row = index.replace('value', 'name');
			            	$(row).addClass('compare-table-hidden');
			            	columns.addClass('compare-table-hidden');
			            }
		            }
			    });
			});
		},
		singleCompareTableHideSimilarities : function() {

			var that = this;
			
			that.settings.compareTableHideSimilaritiesCheckbox.on('change', function(e) {

				var $this = $(this);

				if($this.is(':not(:checked)')) {
					$.each(that.singleCompareValues, function(i, index) {
						$(index).removeClass('compare-table-hidden');
					});
				  	return;
				}


				
	            $.each(that.singleCompareValues, function(i, index){
	            	var values = [];
	            	var columns = $this.parent().parent().find(index);

	            	var i = 0;
	            	$.each(columns, function(){
						if(i == 0 && that.settings.singleCompareTableShowAttrNameInColumn == "1") {
		            		i++;
		            		return;
		            	}

	            		values.push($(this).text());
	        		});

	        		if(values.length > 0) {
			            var allSame = !!values.reduce(function(a, b){ return (a === b) ? a : NaN; });
			            if(allSame == true){
			            	columns.addClass('compare-table-hidden');
			            }
		            }
			    });
			});
		},
		singleCompareTableHighlightDifferences : function() {

			var that = this;
			that.settings.compareTableHighlightDifferencesCheckbox.on('change', function(e) {

				var $this = $(this);

				if($this.is(':not(:checked)')) {
					$.each(that.singleCompareValues, function(i, index) {
						$(index).removeClass('compare-table-highlight');
					});
				  	return;
				}
					
	            $.each(that.singleCompareValues, function(i, index){
	            	var values = [];
	            	var columns = $(index);

	            	var i = 0;
	            	$.each(columns, function(){
						if(i == 0 && that.settings.singleCompareTableShowAttrNameInColumn == "1") {
		            		i++;
		            		return;
		            	}
	            		values.push($(this).text());
	        		});
	        		if(values.length > 0) {
			            var allSame = !!values.reduce(function(a, b){ return (a === b) ? a : NaN; });
			            if(allSame == false){
			            	columns.addClass('compare-table-highlight');
			            }
		            }
			    });
			});

		},
		singleProductSlider : function() {
			var sliderExists = $('.single-product-compare-products-slick');
			if(sliderExists.length > 0) {
				sliderExists.not('.slick-initialized').slick();
			}
		},
		singleCompareTableSlider : function() {
			var sliderExists = $('.woocommerce-single-compare-table-slick');
			if(sliderExists.length > 0) {
				sliderExists.not('.slick-initialized').slick();
			}
		},
		alignCompareTableRowHeight : function() {

			// var classes = {};
			// var compareValues = $('.single-product-compare-value');
			// $(compareValues).each(function() {
			// 	var classs = '.' + ($(this).attr('class').slice(34));
			// 	classes[classs] = classs;
			// });

			$.each(this.singleCompareValues, function(i, index) {
				$(this).matchHeight({byRow: false});
			});
		},
		buildReplaceState : function() {
			var that = this;
			var products = that.products;
			
			if(that.settings.disableReplaceState == "1") {
				return;
			}
			
			that.currentURL = that.removeURLParameter(that.currentURL, 'compare');
			
			var queryCheck = that.currentURL.split('?');
			if (queryCheck.length > 1 && queryCheck[1] !== '') {
				var url = that.currentURL + '&';
			} else if(queryCheck.length > 1 && queryCheck[1] == '') {
				var url = that.currentURL;
			} else {
				var url = that.currentURL + '?';
			}
			if(!that.isEmpty(products)) {
				url += 'compare=' + Object.keys(products).map(function(k){return products[k]}).join(",");;
			}

			window.history.replaceState('woo_better_compare', 'WooCommerce Better Compare', url);
		},
		getParameterByName : function (name, url) {
		    if (!url) url = window.location.href;
		    name = name.replace(/[\[\]]/g, "\\$&");
		    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
		        results = regex.exec(url);
		    if (!results) return null;
		    if (!results[2]) return '';
		    return decodeURIComponent(results[2].replace(/\+/g, " "));
		},
		removeURLParameter : function (url, parameter) {
		    //prefer to use l.search if you have a location/link object
		    var urlparts= url.split('?');   
		    if (urlparts.length>=2) {

		        var prefix= encodeURIComponent(parameter)+'=';
		        var pars= urlparts[1].split(/[&;]/g);

		        //reverse iteration as may be destructive
		        for (var i= pars.length; i-- > 0;) {    
		            //idiom for string.startsWith
		            if (pars[i].lastIndexOf(prefix, 0) !== -1) {  
		                pars.splice(i, 1);
		            }
		        }

		        url= urlparts[0]+'?'+pars.join('&');
		        return url;
		    } else {
		        return url;
		    }
		},
		//////////////////////
		///Helper Functions///
		//////////////////////
		isEmpty: function(obj) {

		    if (obj == null)		return true;
		    if (obj.length > 0)		return false;
		    if (obj.length === 0)	return true;

		    for (var key in obj) {
		        if (hasOwnProperty.call(obj, key)) return false;
		    }

		    return true;
		},
		saveCookie: function(name, value, days) {

			var expires = "";
			if (days) {
		        var date = new Date();
		        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		        expires = "; expires=" + date.toGMTString();
		    }

			var cookie = name + '=' + JSON.stringify(value) + expires + '; path=/;';
			document.cookie = cookie;
		},
		readCookie: function(name) {
			var result = document.cookie.match(new RegExp(name + '=([^;]+)'));
			result && (result = JSON.parse(result[1]));
			return result;
		},
		deleteCookie: function(name) {
			document.cookie = [name, '=; expires=Thu, 01-Jan-1970 00:00:01 GMT; path=/;'].join('');
		},
		getObjectSize : function(obj) {
		    var size = 0, key;
		    for (key in obj) {
		        if (obj.hasOwnProperty(key)) size++;
		    }
		    return size;
		},
	} );

	// Constructor wrapper
	$.fn[ pluginName ] = function( options ) {
		return this.each( function() {
			if ( !$.data( this, "plugin_" + pluginName ) ) {
				$.data( this, "plugin_" +
					pluginName, new Plugin( this, options ) );
			}
		} );
	};

	$.fn.emulateTransitionEnd = function (duration) {
		var called = false
		var $el = this
		$(this).one('bsTransitionEnd', function () { called = true })
		var callback = function () { if (!called) $($el).trigger($.support.transition.end) }
		setTimeout(callback, duration)
		return this
	}

	$(document).ready(function() {

		$( "body" ).compareProducts( 
			woocommerce_better_compare_options
		);

	} );

})( jQuery );