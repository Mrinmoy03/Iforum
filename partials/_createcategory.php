<!-- Modal -->




<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="categoryModalLabel">Create a new Category for Discuss</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/phpt/project/online%20Forum/"  method="post">
            <div class="modal-body">
                <!-- form -->
                    <div class="mb-3">
                        <label for="ctitle" class="form-label">Category Title</label>
                        <input type="text" class="form-control" id="ctitle" name="ctitle" aria-describedby="emailHelp">
                        
                    </div>
                    <div class="mb-3">
                        <label for="cdesc" class="form-label">Category Description</label>
                        <input type="text" class="form-control" id="cdesc" name="cdesc">
                    </div>
                    
                  
                    <button type="submit" class="btn btn-success">Submit</button>
                    
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  
                </div>
            </form>
        </div>
    </div>
</div>