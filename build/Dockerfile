
FROM centos:6.4

ADD files /root/docker
RUN ls -l /root/docker
RUN /root/docker/scripts/epel.sh
RUN /root/docker/scripts/remi.sh
RUN /root/docker/scripts/os.sh
RUN /root/docker/scripts/php54.sh

# Open SSH and Apache ports
EXPOSE  80 22

# supervisord is the entrypoint so that it can start Apache and SSH
CMD ["/usr/bin/supervisord", "-n"]
