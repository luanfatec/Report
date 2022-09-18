# report

O Report, é um software criado em PHP para a coleta de dados de registros de ligações, disponibilizados por uma API da central de atendimento King Voice (empresa localizada em Ourinhos-SP). 
Todos os dados coletados, são armazenados em uma base dados separados, já com os dados tratados e normalizados, podendo assim, entregar a uma dashboard do Power Bi, Grafana, entre outras customizáveis. 
Os créditos desse projeto são entregues a [Kink Voice](https://kingvoice.com.br/) e ao Grupo CedNet, que foram os principais pontos de partida. 
O Report, apenas roda em background, sendo configurado no Crontab como uma tarefa de execução diária. 
