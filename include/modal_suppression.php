<!-- modal de modification -->
<div class="modal fade" id="<?= $supprId?>" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">confirmer votre suppression</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                                </div>
                                <div class="modal-body">
                                    <h5>
                                        vouler vous vraiment supprimer cette activité
                                    </h5>
                                </div>
                                <div class="modal-footer">
                                    <a href="../model/suppr_activite.php?id=<?= $value['id_a'] ?>" class="btn btn-danger">OUI(je veut supprimer)</a>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">NON</button>
                                </div>
                            </div>
                        </div>
                    </div>