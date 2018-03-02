# agenda
sistema de agenda com login e dashboard

# configuração
Alterar as configurações do banco no arquivo Config/config.php
Habilitar o modo rewrte do apache sudo a2enmod && service apache2 restart


Criar regra no hosts
Wind -> C:\Windows\System32\drivers\etc\hosts
Linux ->/etc/hosts

127.0.0.1 agenda.com.br

criar virtual host 
wind -> /xampp/apache/conf/extra/httpd-vhosts.conf
Linux -> /etc/apache2/sites-avaible/000-default.conf
<VirtualHost *:80>
    ServerName agenda.com.br
    ServerAlias www.agenda.com.br
    DocumentRoot "C:\xampp\htdocs\agenda"
    ErrorLog "logs/agenda-error.log"
    CustomLog "logs/agenda-access.log" common
    <Directory "C:\xampp\htdocs\agenda">
        DirectoryIndex index.php index.html index.htm
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>

Exportar os arquivos .sql
