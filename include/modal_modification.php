<!-- modal de modification -->
<div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Modifier l'activité</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                                </div>
                                <div class="modal-body">
                                    <form action="../model/modifier_tache.php" method="post" class="form-group">
                                        <input type="hidden" name="id_a" value="<?= $value['id_a'] ?>">
                                        <label for="edit_description">Description</label>
                                        <input type="text" class="form-control" name="description" value="<?= $value['description'] ?>">
                                        <label for="edit_date_d">Date début</label>
                                        <input type="date" class="form-control" name="date_d" value="<?= $value['date_d'] ?>">
                                        
                                        <label for="edit_date_f">Date fin</label>
                                        <input type="date" class="form-control" name="date_f" value="<?= $value['date_f'] ?>">
                                        
                                        <button type="submit" class="btn btn-primary mt-2" name="ajout">Enregistrer</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>