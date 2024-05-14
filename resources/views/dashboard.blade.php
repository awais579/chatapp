<x-app-layout>

   <div class="container-fluid  bg-white p-4">
        <div class="row align-items-cneter justify-content-between">
          <div class="col-md-2">
                <ul>
                    @foreach ($users as $user )
                        <li onclick="getId({{$user->id }})" class="p-2 mb-2 text-white fw-bold" style="background-color:#b8e994 ; cursor:pointer" > {{$user->name}}</li>
                    @endforeach
                </ul>
          </div>
         
          <div class="col-md-10 border overflow-y-scroll d-flex flex-column" id="messageBody" style="height:400px">

          </div>

          <div class=" w-100 ">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-md-8 border">
                            <input type="text" id="myInput" class="w-100" placeholder="Enter your message">
                        </div>
                        <div class="col-md-4 d-flex align-items-start">
                            <button onclick="sendMessage({{$id}})"  class="btn btn-success">Send</button>
                        </div>
                    </div>
                </div>

        </div>
   </div>
  
<script>
    
    let messageBody = document.getElementById('messageBody');
    let senderId ;
    function getId(id){
        receiverId=  id ;
        
    }  
    function sendMessage(id){
        
        let myInput = document.getElementById('myInput').value;
        if(myInput == ''){   
            alert('please enter your message');
        }else{
            if(receiverId){
                let data = {
                'to_user_id' : senderId,
                'content' : myInput  
            } 
            $.ajax({
                url: "{{ route('sendMessage') }}",
                type: "POST",
                data: data,
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
                }).then((res) => {
                    
                    let filteredData = res.filter(item => item.to_user_id === receiverId);
                    
                    let lastMsg = filteredData.slice(-1);
                    lastMsg.forEach(element => {
                        var messageElement = document.createElement("p");
                        messageElement.classList.add("myMsg","user");
                        messageElement.textContent = element.content;
                        messageBody.appendChild(messageElement);
                    });

                    // let userMsg = res.filter(item => item.to_user_id === id);

                    console.log(filteredData)    
              
                    
                }).catch((err) => {
                    console.log(err);
                });
            }
        }
     
    }
       

</script>
   
</x-app-layout>
<!-- let myData = res.filter(item => item.to_user_id === id); -->
<!-- myLastMsg.forEach(element => {
                        var messageElement = document.createElement("p");
                        messageElement.classList.add("myMsg");
                        messageElement.textContent = element.content;
                        messageBody.appendChild(messageElement);
                    });
                    console.log(myLastMsg,lastMsg  ) -->