Vagrant.configure(2) do |config|

    config.vm.box = "ubuntu/trusty64"

    config.vm.network "forwarded_port", guest: 80, host: 8080
    config.vm.network "forwarded_port", guest: 3306, host: 33060
    config.vm.network "private_network", ip: "10.0.10.10"

    config.vm.synced_folder ".", "/home/vagrant/Hosted"

    config.vm.provider "virtualbox" do |vb|
        vb.gui = false
        vb.memory = "1024"
    end

end

