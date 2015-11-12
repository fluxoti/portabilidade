#! /usr/bin/env bash

# Checking if the script is running as root
if [ "$EUID" -ne 0 ]
  then printf "${RED}Please run as root${NC}\n"
  exit
fi

if [ ! -f Config ];
then
   printf "${RED}Por favor, crie o arquivo \"Config\" (um exemplo está disponível no arquivo Config.example).${NC}\n"
   exit
fi

. Config