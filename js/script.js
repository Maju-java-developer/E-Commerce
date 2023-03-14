function readURL(input , $imagePreviewid) {
  // alert("Function is Working!");
  if (input.files && input.files[0]) {
    // alert("File Exists!");
    var reader = new FileReader();
      
      reader.onload = function (e) {
        // alert("Image Result: " + e.target.result);
          $($imagePreviewid).attr('src', e.target.result);
          // window.open("?page=imageUpdate&imageStatus=true");
      }
      reader.readAsDataURL(input.files[0]);
  } 
}


// $("#product_img").change(function(){
//   alert("Working Read Function");
//   readURL(this, '#product_img_preview');
// });

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" headerDotActive", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " headerDotActive";
}

function redirectTo(url){
  return window.location.href = url;
}

// function getProductID(element){
//   alert("WOrking!");
//   // $product_ID = $(element).attr("product_id");
//   // return window.location.href = "?product_ID" ;
//   // window.location.href = "?product_id=" + $product_ID;
//   // window.open("?product_id=" + $(element).attr('product_id'));
// }

function postCategory(){
const cat_title = $('#cat_title').val();
const cat_desc = $('#cat_desc').val();

const cat_options = document.getElementById("choose_cat");
const cat_options_model = document.getElementById("choose_cat_modal");
const sub__parent_cat_options_ = document.getElementById("csub_parent_cat");

cat_options.innerHTML += "<option>" + cat_title + "</option>";
cat_options_model.innerHTML += "<option>" + cat_title + "</option>";
sub__parent_cat_options_.innerHTML += "<option>" + cat_title + "</option>";

window.open("?page=add_cat&cat_title="+cat_title+"&cat_desc="+cat_desc);
}

function postBrand(){
const brand_title = $('#brand_title').val();
const brand_desc = $('#brand_desc').val();
const brand_cat = $('#choose_cat_modal').val();

const brnad_option = document.getElementById('choose_brand');
const brnad_option_modal = document.getElementById('choose_brand_modal');

brnad_option.innerHTML += "<option>"+ brand_title +"</option>";
brnad_option_modal.innerHTML += "<option>"+ brand_title +"</option>";

window.open("?page=add_brand&brand_title="+brand_title+"&brand_desc="+brand_desc+"&brand_cat="+brand_cat);
}

function postModel(){
const model_title = $('#model_title').val();
const model_desc = $('#model_desc').val();
const model_cat = $('#choose_brand_modal').val();

const model_option = document.getElementById('choose_model');
model_option.innerHTML += "<option>"+ model_title +"</option>";

window.open("?page=add_model&model_title="+model_title+"&model_desc="+model_desc+"&model_cat="+model_cat);
}

function postSubCategory(){
const sub_cat_title = $('#sub_cat_title').val();
const sub_desc_title = $('#sub_cat_desc').val();
const parent_cat = $('#sub_parent_cat').val();

const sub_cat_option = document.getElementById('choose_sub_cat');
sub_cat_option.innerHTML += "<option>"+ sub_cat_title +"</option>";

window.open("?page=add_sub_cat&sub_cat_title="+sub_cat_title+"&sub_cat_desc="+sub_desc_title+"&sub_parent_cat="+parent_cat);
}

function addVariantSlot(){
const variantTitle = $('#variant_title').val();
const variantDesc = $('#variant_desc').val();
const variantValues = $('#variant_values').val();
const variantSlot = $('#variants');

variantSlot.append(
  '<div onclick="removeVariant(this)" class="variant-slot pt-2 pb-2 pl-3 pr-3 m-1 ml-2 bg-dark text-light float-left" style="border-radius: 15px;" id="'+ variantTitle + '_' + variantValues +'" values-attrib="' + variantValues + '" desc-attrib="'+ variantDesc +'">'+ variantTitle + 
  '</div>'
);

// onclick="removeVariant(this)"
}

function removeVariant(element){
  $(element).remove();
}

function addRemovedVarints(varints_title){
  const delete_variants_conatniar = $("#deleted_varaints_contanir");
  delete_variants_conatniar.append(
    "<h5 class='delete-variant-slot bg-danger p-2 mb-1 text-light' style='border-radius: 5px;'>"+ varints_title +"</h5>"
  );
}

function removeEditVariant(element){
  $("#" + element).remove();
}

function test(){
  alert('working test!');
}

function getVariantValuesForDelete(pid,p_rid){
  const variants = document.getElementsByClassName('delete-variant-slot');
  var tempTitles = '';
  for(var i = 0; i < variants.length; i++){
    tempTitles += variants[i].innerHTML + ":";
  }
  // alert('Data : ' + tempTitles);
  if(tempTitles != ""){
    window.open("?page=request_delete&productRelID="+ p_rid + "&product_id="+pid+"&variants_data="+tempTitles);
  }
  // window.open("?page=add_product&variants_title="+variants_title+"&variants_values="+varaints_values+"&variants_desc="+variants_desc);
}

function getVariantValues(usage){
  const variants = document.getElementsByClassName('variant-slot');
  var tempTitles = '';
  var tempValues = '';
  var tempDesc = '';
  for(var i = 0; i < variants.length; i++){
    variants_title.push(variants[i].innerHTML);
    varaints_values.push(variants[i].getAttribute('values-attrib'));
    variants_desc.push(variants[i].getAttribute('desc-attrib'));
    
    tempTitles += variants[i].innerHTML + ":";
    tempValues += variants[i].getAttribute('values-attrib') + ":";
    tempDesc += variants[i].getAttribute('desc-attrib') + ":";
  }

  if(variants.length != 0){
    window.open("?page=add_product&variants_title="+tempTitles+"&variants_values="+tempValues+"&variants_desc="+tempDesc);
  }
  // window.open("?page=add_product&variants_title="+variants_title+"&variants_values="+varaints_values+"&variants_desc="+variants_desc);
}

function getVariantValuesEdit(pid){
  const variants = document.getElementsByClassName('variant-slot');
  var tempTitles = '';
  var tempValues = '';
  var tempDesc = '';
  for(var i = 0; i < variants.length; i++){
    variants_title.push(variants[i].innerHTML);
    varaints_values.push(variants[i].getAttribute('values-attrib'));
    variants_desc.push(variants[i].getAttribute('desc-attrib'));
    
    tempTitles += variants[i].innerHTML + ":";
    tempValues += variants[i].getAttribute('values-attrib') + ":";
    tempDesc += variants[i].getAttribute('desc-attrib') + ":";
  }

  if(variants.length != 0){
    window.open("?page=edit_product&product_id="+ pid +"&variants_title="+tempTitles+"&variants_values="+tempValues+"&variants_desc="+tempDesc);
  }
  // window.open("?page=add_product&variants_title="+variants_title+"&variants_values="+varaints_values+"&variants_desc="+variants_desc);
}

function autoMargin(){
const ParchingPrice = document.getElementById("product_parching_price").value;
const sellingPrice = document.getElementById("Product_selling_price").value;
const totalMargin = (sellingPrice - ParchingPrice);

const margin = document.getElementById("margin").value = totalMargin;
}

function autoSellingPrice(){
const ParchingPrice = document.getElementById("product_parching_price").value;
const margin = document.getElementById("margin").value;

var totalSellingPrice = ParchingPrice - margin;

const sellingPrice = document.getElementById("Product_selling_price").value = totalSellingPrice + (2 * margin);
}

function openVariantsValues(id){
  const varints_title = document.getElementById(id);

  if(varints_title.style.display == "block"){
    varints_title.style.display = "none";
  }else {
    varints_title.style.display = "block";
  }  
} 

function openBrandsByCategory(id){
  const varints_title = document.getElementById(id);

  if(varints_title.style.display == "block"){
    varints_title.style.display = "none";
  }else {
    varints_title.style.display = "block";
  }  
  } 

function add_item(index, qty_limit){
  var item = parseInt($("#item_qty_"+index).val());
  var add = (item + 1);

  if(qty_limit <= item){
    // Set Alert Of Qty
    const item_alert = document.getElementById("item_qty_alert_"+index);
    item_alert.style.display = "block"; 
    item_alert.innerHTML = "Seller has just " +qty_limit + " items of this product!";
    // Set Alert Of Qty

  }else{
    document.getElementById("item_qty_"+index).value = add;
  }

}

function sub_item(index){
  item = $("#item_qty_"+index).val();
  const item_alert = document.getElementById("item_qty_alert_"+index);
  if(item > 1){
    item_alert.style.display = "none"; 
    document.getElementById("item_qty_"+index).value = (item - 1);
  }
}

var dataCollection = 0;

function getCheckedStatus(element,index){
  var totalPriceContanir = document.getElementById("total_amount");
  dataCollection = parseInt($("#total_amount").text());

  const add_button = document.getElementById("add_btn_"+index);
  const sub_button = document.getElementById("sub_btn_"+index);
  const item_qty = document.getElementById("item_qty_"+index);

  if($(element).is(":checked")){
    var price = $(element).attr("price");
    var qty = $("#item_qty_" + index).val();
    var add_total = (parseInt(price) * (parseInt(qty)));
  
    totalPriceContanir.innerHTML = ((parseInt(dataCollection)) + add_total);
    
    add_button.disabled = true;
    sub_button.disabled = true;
    item_qty.disabled = true;

  }else {
    var price = $(element).attr("price");
    var qty = $("#item_qty_" + index).val();
    var add_total = (parseInt(price) * (parseInt(qty)));
  
    totalPriceContanir.innerHTML = ((parseInt(dataCollection)) - add_total);

    add_button.disabled = false;
    sub_button.disabled = false;
    item_qty.disabled = false;

  }
}

function getCheckedStatusQty(element,index,qty_limit){
  const item_qty = $("#item_qty_"+index).val();
  const item_alert = document.getElementById("istem_qty_alert_"+index);

  if(qty_limit < item_qty){
    // Set Alert Of Qty
    item_alert.style.display = "block"; 
    item_alert.innerHTML = "Seller has just " +qty_limit + " items of this product!";
    // Set Alert Of Qty
    document.getElementById("item_qty_"+index).value = qty_limit;
  }else {
    item_alert.style.display = "none"; 
  }  
}

function isSelected(element){
  if($(element).is(":checked")){
    return true;
  }
  return false;
}

function redirectOrdersTo(url, orderElements){

  var orders = "";
  var qty = "";
  var price = 0;

  // alert(orderElements.length);
  var selection = 0;
  for(var i = 0; i < orderElements.length; i++){
    if(isSelected($("#checked_item_" + i))){
      orders += "ID_" + orderElements[i].innerHTML + "|";
      qty += "QTY_" + $("#item_qty_" + i).val() + "|";
      price += (parseInt($("#checked_item_" + i).attr("price"))) * (parseInt($("#item_qty_" + i).val()));
      selection += 1;
    }
  }

  if(selection > 0){
    return window.location.href = url + "&ItemIDs=" + orders + "&ItemQTY=" + qty + "&totalPrice=" + price;
  }else{
    alert("Select Any First!");
  }
}

function checkQty(element){
  // alert("Elem: " + element.value);
  if(parseInt(element.value) == 0 || parseInt(element.value) < 0){
    element.value = 1;
  }

}

function isDeliveryInformationEmpty(){
  const full_name = $("#full_name").val();
  const province = $("#province").val();
  const phone_number = $("#phone_number").val();
  const gmail = $("#gmail").val();
  const city = $("#city").val();
  const area = $("#area").val();
  const billing_address = $("#billing_address").val();
  const delivery_address = $("#delivery_address").val();

  const delivery_info_btn = document.getElementById("delivery_info_btn");
  if(full_name != "" && province != "" && phone_number != "" && gmail != "" && city != "" && area != "" && billing_address != "" && delivery_address != ""){
    delivery_info_btn.disabled = false;
  }else {
    delivery_info_btn.disabled = true;
  }
}

function selectAll(element){
  var total_price = document.getElementById("total_amount").innerHTML;

  var count = document.getElementsByClassName("count").length;
  var dataCollection = 0;
  
  if($(element).is(":checked")){
      for (let i = 0; i < count; i++) {
        if(!isSelected($("#checked_item_"+i))){
          var itemPrice = $("#item_qty_"+i).attr("price");
          var itemQty = $("#item_qty_"+i).val();
          $("#checked_item_"+i).prop("checked", true);

          document.getElementById("add_btn_"+i).disabled = true;
          document.getElementById("sub_btn_"+i).disabled = true;
          document.getElementById("item_qty_"+i).disabled = true;

          // add_button.disabled = true;
          // sub_button.disabled = true;
          // item_qty.disabled = true;

          dataCollection += parseInt(itemPrice) * parseInt(itemQty); 
          // alert("Index: " + i +"\n Price: " + itemPrice + "\n Item Qty: " + itemQty + "\n dataCollection: " + dataCollection); 
          document.getElementById("total_amount").innerHTML = (dataCollection + parseInt(total_price));
          
        }
      }  
    }else {
    for (let i = 0; i < count; i++) {

      document.getElementById("add_btn_"+i).disabled = false;
      document.getElementById("sub_btn_"+i).disabled = false;
      document.getElementById("item_qty_"+i).disabled = false;

      $("#checked_item_"+i).prop("checked", false); 
      document.getElementById("total_amount").innerHTML = "00";
    }
  
  }
}

function redirectDeliveryInfoTo(url){

  const full_name = $("#full_name").val();
  const province = $("#province").val();
  const phone_number = $("#phone_number").val();
  const gmail = $("#gmail").val();
  const city = $("#city").val();
  const area = $("#area").val();
  const billing_address = $("#billing_address").val();
  const delivery_address = $("#delivery_address").val();

  return window.location.href = url +
    "&full_name=" + full_name +
    "&proviece=" + province +
    "&phone_number="+ phone_number + 
    "&gmail=" + gmail +
    "&city=" + city + 
    "&area=" + area + 
    "&billing_address=" + billing_address + 
    "&delivery_address=" + delivery_address
  ;
}
