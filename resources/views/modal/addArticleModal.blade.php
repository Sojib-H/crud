
 

  <!-- edit Modal -->
  <div class="modal fade" id="editArticleModal" tabindex="-1" role="dialog" aria-labelledby="editArticleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editArticleModalLabel">Add Article</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <form id="editArticle">
             @csrf
             <div class="form-group">
                 <input type="hidden" name="article_id" id="article_id">
             </div>
             <div class="form-group">
                 <label for="edit_name">Title</label>
                 <input type="text" class="form-control" id="edit_name" name="edit_name">
                 <small id="edit_name_help" class="form-text text-danger"></small>
             </div>
             <div class="form-group">
              <label for="edit_name_bangla">Title</label>
              <input type="text" class="form-control" id="edit_name_bangla" name="edit_name_bangla">
              <small id="edit_name_bangla_help" class="form-text text-danger"></small>
          </div>
             <div class="form-group">
                 <label for="edit_description">Description</label>
                 <textarea class="form-control" name="edit_description" id="edit_description" cols="30" rows="10"></textarea>
                 <small id="edit_description_help" class="form-text text-danger"></small>
             </div>
             <div class="form-group">
                <label for="edit_image">Image</label>
                <input type="file" class="form-control-file" id="edit_image" name="edit_image">
                <small id="edit_image_help" class="form-text text-danger"></small>
            </div>

            <button class="btn btn-primary" type="submit">Update Article</button>
         </form>
        </div>
        
      </div>
    </div>
  </div>