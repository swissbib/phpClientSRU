simple PHP client to access the SRU interface
========================================================================================

Description
-----------

Taylored for NB Hackathon, Berne (27.2.2015), to simplify the usage of library meta data.
 
This client is based on https://github.com/swissbib/swissbibMobile

For more information about the SRU interface go to http://sru.swissbib.ch 
This interface is heavily used by the German KVK http://www.ubka.uni-karlsruhe.de/kvk.html


Currently swissbib is developing a linked data infrastructure with various interfaces for public access  
- e.g. a REST interface for RDF data.

 At the moment this work is in early infancy state but nevertheless accessible 
http://sb-vf22.swissbib.unibas.ch/resource
You can find the Gitub repository on 
https://github.com/linked-swissbib/linkedSwissbibREST

Using content negotiation clients will be able to access the API e.g. in this way:
curl  -s -H "Accept: application/vnd.linked-swissbib.v1+json" http://sb-vf22.swissbib.unibas.ch/resource | python -mjson.tool

Rolemodel for the linked-data REST API is http://lobid.org
Be aware: at the moment a lot of things are not stable and matter of change. You can expect a first stable version late spring or beginning of summer 2015

If your are interested in this work - let us know!



For more informaton about the swissbib infrastructure visit the swissbib blog: http://swissbib.blogspot.ch/ 



Basel, 26.2.2015, swissbib team

