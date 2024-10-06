<!-- Modal -->
<div class="modal fade" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="chatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chatModalLabel">Chat Window</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Chat messages will be displayed here -->
                <div id="chatMessages"></div>
                <!-- Input field for new message -->
                <input type="text" id="message" class="form-control" placeholder="Enter your message">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="send" class="btn btn-primary">Send</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        // Function to load chat messages
        function loadChat(){
            $.ajax({
                url: 'getMessages.php',
                type: 'GET',
                success: function(response){
                    $('#chatMessages').html(response);
                }
            });
        }

        // Function to send a message
        $('#send').click(function(){
            var message = $('#message').val();
            $.ajax({
                url: 'sendMessage.php',
                type: 'POST',
                data: { message: message },
                success: function(response){
                    $('#message').val('');
                    loadChat(); // Reload chat after sending message
                }
            });
        });

        // Trigger chat load when modal is shown
        $('#chatModal').on('shown.bs.modal', function (e) {
            loadChat();
        });
    });
</script>