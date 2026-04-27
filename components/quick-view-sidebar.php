<!-- Quick View Sidebar Start -->
<div data-state="close" class="quick-view-sidebar fixed xl:top-[30px] xl:right-[22px] right-0 top-0 xl:h-[calc(100vh-52px)] h-full z-99 max-w-[950px] w-full bg-white xl:rounded-2xl rounded-none transition-all duration-250 ease-[cubic-bezier(0.645,0.045,0.355,1)] data-[state=open]:translate-x-0 data-[state=open]:opacity-100 data-[state=open]:visible data-[state=close]:translate-x-[200px] data-[state=close]:opacity-0 data-[state=close]:invisible">
    <div class="quick-view-sidebar-header px-6 py-[15px] border-b border-gray-300 relative">
        <h5>Quick View</h5><button data-close-sidebar=".quick-view-sidebar" class="close-sidebar-btn absolute top-1/2 right-6 -translate-y-1/2 cursor-pointer inline-flex items-center justify-center size-9 rounded-full bg-[rgba(145,158,171,0.08)]"><i class="hgi hgi-stroke hgi-multiplication-sign text-xl leading-5 text-light-primary-text"></i></button>
    </div>
    <div class="quick-view-sidebar-content lg:flex lg:flex-row p-6 gap-x-6 gap-y-6 lg:gap-y-0 w-full lg:h-full h-[calc(100%-60px)] overflow-y-auto">
        <div class="product-images-wrapper lg:max-w-[350px] w-full lg:flex-none lg:overflow-y-auto lg:h-[calc(100%-60px)] h-auto mb-6 lg:mb-0">
            <div class="space-y-4">
                <img class="max-h-[300px] w-full rounded-xl object-cover" src="assets/images/product-details/product-details-18.png" alt="product-image" />
                <img class="max-h-[300px] w-full rounded-xl object-cover" src="assets/images/product-details/product-details-16.png" alt="product-image" />
                <img class="max-h-[300px] w-full rounded-xl object-cover" src="assets/images/product-details/product-details-17.png" alt="product-image" />
            </div>
        </div>
        <div class="product-details-wrapper w-full lg:flex-1 @container/quick-view-product-details lg:overflow-y-auto lg:h-[calc(100%-60px)] h-auto pr-4">
            <span class="product-discount-badge inline-block mb-4 uppercase relative bg-error text-warning-lighter font-medium text-sm leading-[22px] px-1 after:absolute after:top-0 after:left-full after:z-10 after:w-1 after:h-full after:bg-[url('images/discount-shape.html')] after:bg-contain after:bg-no-repeat">Sales</span>
            <p class="uppercase text-info text-xs leading-[18px] font-bold new-arrival-badge mb-4">New Arrival</p>
            <h4 class="line-clamp-2 mb-4">AE 24/7 Active Hoodie With Gaiter</h4>
            <div class="rating-section flex items-center mb-4">
                <div class="bg-[url('../images/star-icon.png')] w-[90px] h-4.5 bg-repeat-x overflow-hidden bg-position-[0_0]">
                    <div style="width: 80%" class="bg-[url('../images/star-icon.png')] h-4.5 bg-repeat-x bg-position-[0_-18px]"></div>
                </div><span class="font-normal inline-block ml-1">(11.78k reviews)</span>
            </div>
            <div class="price-section flex items-center gap-x-3 mb-6"><span class="current-price text-2xl leading-9 font-bold text-light-primary-text relative after:absolute after:h-6 after:w-px after:bg-gray-300 after:right-0 after:top-1/2 after:-translate-y-1/2 pr-3 inline-block">$62.97</span><span class="old-price text-2xl leading-9 font-normal text-light-disabled-text">$39.99</span><span class="product-discount-badge uppercase relative bg-error text-warning-lighter font-medium text-sm leading-[22px] px-1 after:absolute after:top-0 after:left-full after:z-10 after:w-1 after:h-full after:bg-[url('images/discount-shape.html')] after:bg-contain after:bg-no-repeat">15% OFF</span></div>
            <div class="product-add-to-cart-section py-6 border-b border-dashed border-gray-300 border-t">
                <div class="color-variation-section mb-6">
                    <div class="color-variation-section-title mb-4">
                        <p class="font-semibold text-light-primary-text flex items-center gap-x-2.5">Color: <span class="text-light-primary-text font-normal capitalize color-variation-selected-color">Green</span></p>
                    </div>
                    <div class="color-variation-items flex items-center gap-x-2">
                        <div class="color-variation-item"><button data-color-text="green" data-color="#088178" class="cursor-pointer flex items-center justify-center rounded-full size-10 border border-primary hover:bg-[rgba(145,158,171,0.08)]"><img src="assets/images/product-details/color-selector-1.png" alt="color" /></button></div>
                        <div class="color-variation-item"><button data-color-text="blue" data-color="#3366FF" class="cursor-pointer flex items-center justify-center rounded-full size-10 border border-gray-300 hover:bg-[rgba(145,158,171,0.08)]"><img src="assets/images/product-details/color-selector-2.png" alt="color" /></button></div>
                        <div class="color-variation-item"><button data-color-text="yellow" data-color="#FFC107" class="cursor-pointer flex items-center justify-center rounded-full size-10 border border-gray-300 hover:bg-[rgba(145,158,171,0.08)]"><img src="assets/images/product-details/color-selector-3.png" alt="color" /></button></div>
                        <div class="color-variation-item"><button data-color-text="red" data-color="#CB0233" class="cursor-pointer flex items-center justify-center rounded-full size-10 border border-gray-300 hover:bg-[rgba(145,158,171,0.08)]"><img src="assets/images/product-details/color-selector-4.png" alt="color" /></button></div>
                    </div>
                </div>
                <div class="size-variation-section mb-6">
                    <div class="size-variation-section-title mb-4 flex items-center justify-between">
                        <p class="font-semibold text-light-primary-text flex items-center gap-x-2.5">Size: <span class="text-light-primary-text font-normal capitalize size-variation-selected-size">S</span></p>
                    </div>
                    <div class="size-variation-items flex items-center gap-2 2xl:flex-nowrap flex-wrap"><?php foreach(['S','M','L','XL','XXL','XXXL'] as $i => $size): ?><div class="size-variation-item"><button data-size-text="<?=$size?>" class="cursor-pointer flex items-center justify-center text-sm leading-6 px-[29px] py-<?=($i>2)?'2':'1.5'?> text-light-primary-text font-semibold border <?=($i===0)?'border-primary bg-primary text-white':'border-gray-300 hover:bg-[rgba(145,158,171,0.08)]'?> rounded-[100px]"><?=$size?></button></div><?php endforeach; ?></div>
                </div>
                <div class="product-add-to-cart-btn-section">
                    <p class="font-semibold text-light-primary-text mb-4">Quantity:</p>
                    <div class="flex items-center justify-between gap-x-4 gap-y-4 flex-wrap md:flex-nowrap md:gap-y-0">
                        <div class="quantity-section flex-1 max-w-[126px] border border-gray-300 rounded-[80px] px-4 py-[11px] flex items-center justify-between"><button class="quantity-btn inline-flex items-center justify-center hover:text-primary"><i class="hgi hgi-stroke hgi-minus-sign text-xl leading-5"></i></button><input type="text" class="quantity-input text-center w-full focus:outline-none font-semibold text-base leading-6 text-light-primary-text" value="1" /><button class="quantity-btn inline-flex items-center justify-center hover:text-primary"><i class="hgi hgi-stroke hgi-plus-sign text-xl leading-5"></i></button></div>
                        <div class="flex-1"><a href="#" class="btn btn-warning btn-large rounded-[80px] w-full">Buy Now</a></div>
                        <div class="flex-1"><a href="#" class="btn btn-primary btn-large rounded-[80px] w-full"><i class="hgi hgi-stroke hgi-shopping-cart-add-02 text-2xl leading-6 text-white"></i> Add to Cart</a></div>
                    </div>
                </div>
            </div>
            <div class="product-extra-info-section flex flex-col gap-y-4 my-6"><?php foreach([['Free Shipping:','Estimated Delivery Time 5-7 Days'],['SKU:','SKU-001'],['Categories:','Electronics, Computers, Accessories']] as $info): ?><div class="product-extra-info-item flex items-center gap-x-4 gap-y-4 flex-wrap @md/quick-view-product-details:flex-nowrap @md/quick-view-product-details:gap-y-0">
                <p class="font-semibold text-light-primary-text"><?=$info[0]?></p>
                <p><?=$info[1]?></p>
            </div><?php endforeach; ?></div>
            <div class="accordion" id="product-details-accordion">
                <div class="accordion-item">
                    <div class="accordion-header active">
                        <h5>Description</h5><i class="hgi hgi-stroke hgi-arrow-down-01 text-2xl leading-6"></i>
                    </div>
                    <div class="accordion-body">
                        <p class="mb-6">To begin, carefully unpack the product and ensure all necessary components are included. Place the product on a clean, flat surface before use.</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header">
                        <h5>Additional Info</h5><i class="hgi hgi-stroke hgi-arrow-down-01 text-2xl leading-6"></i>
                    </div>
                    <div class="accordion-body">
                        <table class="w-full border-collapse">
                            <tbody class="divide-y divide-gray-300"><?php foreach([['Product Type','Touchless Infrared Thermometer'],['Brand','Mediguard'],['Model','X200'],['Warranty','1 Year']] as $row): ?><tr>
                                <th class="font-semibold w-[180px] text-left py-3 text-light-primary-text"><?=$row[0]?></th>
                                <td><?=$row[1]?></td>
                            </tr><?php endforeach; ?></tbody>
                        </table>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header">
                        <h5>Reviews</h5><i class="hgi hgi-stroke hgi-arrow-down-01 text-2xl leading-6"></i>
                    </div>
                    <div class="p-0! accordion-body">
                        <div class="grid grid-cols-12 divide-y divide-gray-300 rating-overview">
                            <div class="col-span-12 flex items-center justify-center py-6">
                                <div class="rating-heading space-y-2 text-center">
                                    <p class="font-semibold text-light-primary-text">Average Rating</p>
                                    <h2 class="text-error">4/5</h2>
                                    <div class="rating-section flex items-center justify-center">
                                        <div class="bg-[url('../images/star-icon.png')] w-[90px] h-4.5 bg-repeat-x overflow-hidden bg-position-[0_0]">
                                            <div style="width: 80%" class="bg-[url('../images/star-icon.png')] h-4.5 bg-repeat-x bg-position-[0_-18px]"></div>
                                        </div>
                                    </div>
                                    <p>(8.24k reviews)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quick View Sidebar End -->
