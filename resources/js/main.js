$(document).ready(function(){
    $('.select2-class').select2();
    $('.like').click(function(e){
        e.preventDefault()
       

        var like = e.target.previousElementSibling  == null;
        var post_id = e.target.parentNode.dataset['postid'];
        console.log(post_id)
        var data = {
            isLike:like,
   
            post_id:post_id
        }
        axios.post('/like',data).then(response=>{
          // console.log(response)
           
           $("[data-postid='" + response['data']['post_id']+"'] >.active-like").attr('class','btn btn-link like');
           
           e.currentTarget.className='btn btn-link like active-like'
        })

    });

    $('.friend').click(function(e){
        e.preventDefault();
        
        var friendid = e.target.parentNode.dataset['friendid'];
       
        var data ={
            friendid:friendid,
        }

        axios.post('/friend',data).then(response=>{
            //console.log(response)
            
            //$("[data-friend='" + response['data']['post_id']+"'] >.active-like").attr('class','btn btn-link like');
            
          e.currentTarget.className='btn btn-link remove-friend'
           e.target.innerHTML = ("Remove friend")
         })

    });
    $('.remove-friend').click(function(e){
        e.preventDefault();
        var friendid = e.target.parentNode.dataset['friendid'];
    
        var data ={
            friendid:friendid,
        }

        axios.post('/friend/remove',data).then(response=>{
            //console.log(response)
            
            //$("[data-friend='" + response['data']['post_id']+"'] >.active-like").attr('class','btn btn-link like');
            
          e.currentTarget.className='btn btn-link friend'
           e.target.innerHTML = ("Add friend")
         })

    });


    $('.request').click(function(e){
        e.preventDefault()
       

        var request = e.target.previousElementSibling  == null;
        var user_id = e.target.parentNode.dataset['userid'];
        console.log(user_id)
        var data = {
            isRequest:request,
   
            user_id:user_id
        }
        axios.post('/request',data).then(response=>{
          // console.log(response)
            if(response.data['true']){
           e.currentTarget.parentElement.innerHTML = "<span class='success'>You are now friends</span>";
            }else{
                e.currentTarget.parentElement.innerHTML = "<span class='danger'>You canceled the friend request</span>";
            }
           $("[data-postid='" + response['data']['post_id']+"'] >.active-like").attr('class','btn btn-link like');
           
           e.currentTarget.className='btn btn-link like active-like'
        })

        

    });

})