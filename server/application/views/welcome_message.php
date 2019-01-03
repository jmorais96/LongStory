<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css")?>" >
    <script src="<?php echo base_url("assets/js/bootstrap.min.js")?>"></script>

    <script src="<?php echo base_url("assets/js/jquery-3.3.1.slim.min.js")?>"></script>
    <script src="<?php echo base_url("assets/js/popper.min.js")?>" ></script>

</head>
<body>
<div class="container">
    <br /><br />

    <div id="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Welcome to Long story!</h1>
                <br />
                <p class="lead">Este serviço para é para que possam treinar a utilização de Web Services REST. Se não sabem isto o que é, então estão no sítio errado e podem voltar para onde vieram.</p>
                <p>A api está disponível em <a href="http://controlaltdelete.pt/uac/movie/index.php/api/movie/">http://controlaltdelete.pt/uac/movie/index.php/api/movie/</a></p>

                <p>Para testes utilizem sempre o user_id : 1</p>
                <p>Cada função que utilizarem deverá ser concatenada ao URL</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Criar Filme</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th>Método</th>
                                <td>POST</td>
                            </tr>
                            <tr>
                                <th>Função</th>
                                <td>addMovie</td>
                            </tr>
                            <tr>
                                <th>Argumentos</th>
                                <td>
                                    title: string<br />
                                    year: int<br />
                                    description: string (opcional)<br />
                                    imdb_id: string (opcional)<br />
                                    user_id: string
                                    gender_id : string contendo os ids dos generos separados por ,
                                </td>
                            </tr>
                            <tr>
                                <th>Retorno</th>
                                <td>Devolve um json com um índice código e a mensagem</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Obter Filmes</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th>Método</th>
                                <td>GET</td>
                            </tr>
                            <tr>
                                <th>Função</th>
                                <td>getMovie</td>
                            </tr>
                            <tr>
                                <th>Argumentos</th>
                                <td>
                                    id: int (opcional)<br />
                                </td>
                            </tr>
                            <tr>
                                <th>Retorno</th>
                                <td>Devolve a lista de filmes disponíveis que correspondem ao id. Caso não seja indicado um id, então devolve todos os filmes</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <br />
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Classificar Filme</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th>Método</th>
                                <td>POST</td>
                            </tr>
                            <tr>
                                <th>Função</th>
                                <td>rateMovie</td>
                            </tr>
                            <tr>
                                <th>Argumentos</th>
                                <td>
                                    movie_id: int<br />
                                    user_id: int<br />
                                    rating: int (1-5)<br />
                                    comments: string (opcional)
                                </td>
                            </tr>
                            <tr>
                                <th>Retorno</th>
                                <td>Devolve um json com um índice código e a mensagem</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Obter Géneros</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th>Método</th>
                                <td>GET</td>
                            </tr>
                            <tr>
                                <th>Função</th>
                                <td>getGender</td>
                            </tr>
                            <tr>
                                <th>Argumentos</th>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <th>Retorno</th>
                                <td>Devolve a lista de géneros disponíveis</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>




    </div>

</div>
</body>
</html>
