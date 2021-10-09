


                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#adicionarProduto">
                        Adicionar Produto
                    </button>


                    <!-- Modal de Produtos -->
                    <div class="modal fade" id="adicionarProduto" tabindex="-1" role="dialog" aria-labelledby="adicionarProdutoLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="adicionarProdutoLabel">Adicionando produto</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="inserirProduto.php" method="post" class="jsonForm">
                                        <div class="form-group">
                                            <label for="idproduto">Produto</label>
                                            <select class="form-control" id="idproduto" name="idproduto" required >
                                                <option value="">- Selecione o produto -</option>
                                                <?php
                                                while($linhaProduto = $queryProduto->fetch()){
                                                    echo "<option value='{$linhaProduto->id}'>{$linhaProduto->nome} - R$ {$linhaProduto->valor}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="quantidade">Quantidade</label>
                                            <input type="number" min="1" step="any" class="form-control" id="quantidade" name="quantidade" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="idatendimento" value="<?php echo $_GET['id']; ?>">
                                            <button type="submit" class="btn btn-success" >Salvar</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- fim do modal de Proddutos -->


                    <!-- inicio do bootgrid de produto -->
                    <table id="grid-produto" class="table table-condensed table-hover table-striped">
                        <thead>
                        <tr>
                            <th data-column-id="id" >Código</th>
                            <th data-column-id="nome" data-order="asc" data-sortable="true">Produto</th>
                            <th data-column-id="descricao" data-sortable="true" data-visible="false">Descrição</th>
                            <th data-column-id="valorproduto" data-sortable="true">Valor</th>
                            <th data-column-id="quantidade" data-sortable="true">Quantidade</th>
                            <th data-column-id="commands" data-formatter="commands" data-sortable="false">Ações</th>
                        </tr>
                        </thead>
                    </table>
                    <!-- fim do bootgrid de produto-->
