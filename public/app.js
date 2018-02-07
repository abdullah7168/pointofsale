

 var recipesInOrder = [];
 var subTotal = 0;
 var grandTotal = 0;
 var template = '';
document.getElementById('btn-add-order').addEventListener('click',function(e){
    e.preventDefault();
    var qty = document.getElementById('quantity-box').value;
    var recipe = document.getElementById('recipe-select');
    var id = recipe[recipe.selectedIndex].value; //getting id of selected recipe.
    var parentDataElement = document.querySelector('#parent-data');
    
    for(i=0; i<objRecipe.length; i++){
        if (id == objRecipe[i]["id"]) {
            subTotal = objRecipe[i]["rcp_cp"] * qty;
            template += '<tr>';
            template +=     '<td>'+  objRecipe[i]["rcp_name"]   +'</td>';
            template +=     '<td>' + qty  + '</td>';
            template +=     '<td>' + objRecipe[i]["rcp_cp"] + '</td>';
            template +=     '<td>' + subTotal + '</td>';
            template += '</tr>';

            if(recipesInOrder.length > 0){
                for(j=0; j < recipesInOrder.length; j++){
                    if(recipesInOrder[j]['id'] == id){
                        recipesInOrder[j]['quantity'] = parseInt(recipesInOrder[j]['quantity']) + 1;
                        console.log(recipesInOrder[j]['id']);
                    } else {
                        recipesInOrder.push({id: objRecipe[i]['id'],quantity: qty});
                        break;
                    } 
                }
            } else {
                recipesInOrder.push({id: objRecipe[i]['id'],quantity: qty});
            }
            
            
            
            grandTotal+= subTotal;
            break;
        }
    }
    parentDataElement.innerHTML = '';
    parentDataElement.insertAdjacentHTML('beforeend',template);
    document.getElementById('gtotal').innerText = grandTotal;
    document.getElementById('quantity-box').value = 1;
    
    console.log(recipesInOrder);

});

//ajax request
$('#btn-order').on('click',function(e){

    e.preventDefault();
    if(recipesInOrder.length > 0){
            $.ajax({
            method: 'POST',
            url   :  url,
            data  :  {recipesInOrder, _token : token}
        })
        .done(function(msg){
            //server response
            console.log(msg['message']);
        });
    } else{
        console.log('no recipe ordered');
    }
        
});
