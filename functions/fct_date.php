<?php

/**
 * Transforme une date au format US en une date au format FR
 * 
 * @param date $dateus   Date au format US
 * @return date  Date au format FR 
 */
function dateus2fr($dateus){
	$datefr=explode('-',$dateus);
	return $datefr[2].'/'.$datefr[1].'/'.$datefr[0];
}

/**
 * Transforme une date au format FR en une date au format US
 * 
 * @param date $datefr  Date au format FR
 * @return date  Date au format US
 */
function datefr2us($datefr){
	$dateus=explode('/',$datefr);
	return $dateus[2].'-'.$dateus[1].'-'.$dateus[0];
}